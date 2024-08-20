<?php 

class VatanSMSAPI
{
    const API_ID = 'your_api_key';
    const API_KEY = 'your_api_key';
    const SENDER = 'your_name';
    const MESSAGE_TYPE = 'turkce';
    const MESSAGE_CONTENT_TYPE = 'bilgi';

    private $phones;
    private $message;

    public function __construct($phones, $message)
    {
        $this->phones = $phones;
        $this->message = $message;
    }

    public function sendSMS()
    {
        $curl = curl_init();

        $params = [
            'api_id' => self::API_ID,
            'api_key' => self::API_KEY,
            'sender' => self::SENDER,
            'message_type' => self::MESSAGE_TYPE,
            'message' => $this->message,
            'message_content_type' => self::MESSAGE_CONTENT_TYPE,
            'phones' => $this->phones,
        ];

        $curl_options = [
            CURLOPT_URL => 'https://api.vatansms.net/api/v1/1toN',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json'
            ]
        ];

        curl_setopt_array($curl, $curl_options);

        $response = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($response, true);

        if ($result['status'] === 'success') {
            return '1';
        } else {
            return '0';
        }
    }
}

?>