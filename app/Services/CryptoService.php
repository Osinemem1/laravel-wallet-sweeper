<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use Web3\Web3;
use Web3\Utils;
use Web3p\EthereumTx\Transaction;
use Web3\Contracts\Ethabi;

class CryptoService
{
    protected $web3;
    protected $eth;
    protected $ethabi;
    protected $rpcUrl;

    public function __construct()
    {
        $this->rpcUrl = config('services.ethereum.rpc_url');
        $this->web3 = new Web3($this->rpcUrl);
        $this->eth = $this->web3->eth;
        $this->ethabi = new Ethabi();
    }

    /**
     * Send native ETH from one wallet to another
     */
    public function sendNativeEth($fromWallet, string $toAddress, $amount)
    {
        $fromAddress = $fromWallet->address;
        $privateKey = $fromWallet->private_key;

        // Convert amount (in ETH) to Wei
        $value = Utils::toWei((string)$amount, 'ether');

        // Get nonce
        $nonce = null;
        $this->eth->getTransactionCount($fromAddress, function ($err, $txCount) use (&$nonce) {
            if ($err !== null) {
                throw new \Exception('Nonce error: ' . $err->getMessage());
            }
            $nonce = $txCount->toString();
        });
        if ($nonce === null) {
            throw new \Exception('Failed to fetch nonce.');
        }

        // Get gas price
        $gasPrice = null;
        $this->eth->gasPrice(function ($err, $result) use (&$gasPrice) {
            if ($err !== null) {
                throw new \Exception('Gas price error: ' . $err->getMessage());
            }
            $gasPrice = $result->toString();
        });
        if ($gasPrice === null) {
            throw new \Exception('Failed to fetch gas price.');
        }

        $gasLimit = '21000'; // For simple ETH transfer

        $txParams = [
            'nonce' => '0x' . dechex($nonce),
            'gasPrice' => '0x' . dechex($gasPrice),
            'gasLimit' => '0x' . dechex($gasLimit),
            'to' => $toAddress,
            'value' => '0x' . dechex($value),
            'chainId' => 1, // Ethereum mainnet
        ];

        // Sign and send
        $transaction = new Transaction($txParams);
        $signedTx = '0x' . $transaction->sign($privateKey);

        $txHash = null;
        $this->eth->sendRawTransaction($signedTx, function ($err, $hash) use (&$txHash) {
            if ($err !== null) {
                throw new \Exception('Send ETH error: ' . $err->getMessage());
            }
            $txHash = $hash;
        });

        if ($txHash === null) {
            throw new \Exception('ETH transfer failed.');
        }

        return $txHash;
    }

    /**
     * Send ERC-20 tokens (already complete)
     */
    public function sendToken($fromWallet, string $toAddress, $amount, string $tokenContractAddress)
    {
        $decimals = $this->getTokenDecimals($tokenContractAddress);
        $tokenAmount = bcmul((string)$amount, bcpow('10', $decimals, 0), 0);

        $transferFnSignature = 'transfer(address,uint256)';
        $methodId = substr($this->keccak256($transferFnSignature), 0, 8);
        $encodedParams = $this->ethabi->encodeParameters(['address', 'uint256'], [$toAddress, $tokenAmount]);
        $data = '0x' . $methodId . substr($encodedParams, 2);

        $fromAddress = $fromWallet->address;
        $privateKey = Crypt::decryptString($fromWallet->private_key); // Ensure decrypted

        $nonce = null;
        $this->eth->getTransactionCount($fromAddress, function ($err, $txCount) use (&$nonce) {
            if ($err !== null) {
                throw new \Exception('Nonce error: ' . $err->getMessage());
            }
            $nonce = $txCount->toString();
        });
        if ($nonce === null) {
            throw new \Exception('Failed to fetch nonce.');
        }

        $gasPrice = null;
        $this->eth->gasPrice(function ($err, $result) use (&$gasPrice) {
            if ($err !== null) {
                throw new \Exception('Gas price error: ' . $err->getMessage());
            }
            $gasPrice = $result->toString();
        });
        if ($gasPrice === null) {
            throw new \Exception('Failed to fetch gas price.');
        }

        $gasLimit = '100000'; // Can also estimate dynamically if needed

        $txParams = [
            'nonce' => '0x' . dechex($nonce),
            'gasPrice' => '0x' . dechex($gasPrice),
            'gasLimit' => '0x' . dechex($gasLimit),
            'to' => $tokenContractAddress,
            'value' => '0x0',
            'data' => $data,
            'chainId' => 1, // Use 1 for mainnet, or 11155111 for Sepolia testnet
        ];

        $transaction = new Transaction($txParams);
        $signedTx = '0x' . $transaction->sign($privateKey);

        $txHash = null;
        $this->eth->sendRawTransaction($signedTx, function ($err, $hash) use (&$txHash) {
            if ($err !== null) {
                throw new \Exception('Send tx error: ' . $err->getMessage());
            }
            $txHash = $hash;
        });

        if ($txHash === null) {
            throw new \Exception('Transaction failed to send.');
        }

        return $txHash;
    }

    /**
     * Get live on-chain token balance
     */
    public function getTokenBalance(string $walletAddress, string $tokenContractAddress): string
    {
        $methodSignature = 'balanceOf(address)';
        $methodId = substr($this->keccak256($methodSignature), 0, 8);
        $encodedAddress = $this->ethabi->encodeParameters(['address'], [$walletAddress]);
        $data = '0x' . $methodId . substr($encodedAddress, 2);

        $balance = null;
        $this->eth->call([
            'to' => $tokenContractAddress,
            'data' => $data,
        ], function ($err, $result) use (&$balance) {
            if ($err !== null) {
                throw new \Exception('Error fetching token balance: ' . $err->getMessage());
            }
            $balance = $result;
        });

        if ($balance === null) {
            throw new \Exception('Failed to fetch token balance.');
        }

        $balanceInt = hexdec(substr($balance, 2));
        $decimals = $this->getTokenDecimals($tokenContractAddress);

        return bcdiv($balanceInt, bcpow('10', $decimals, 0), $decimals);
    }
    protected function keccak256($input)
    {
        return hash('sha3-256', $input);
    }


    // TO GET ETHBALANCE
    public function getEthBalance(string $walletAddress): string
    {
        $balance = null;

        $this->eth->getBalance($walletAddress, function ($err, $result) use (&$balance) {
            if ($err !== null) {
                throw new \Exception('ETH balance error: ' . $err->getMessage());
            }
            $balance = Utils::toDecimal($result, 18);
        });

        if ($balance === null) {
            throw new \Exception('Failed to fetch ETH balance.');
        }

        return $balance;
    }
}

