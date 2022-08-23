<?php
class Home extends Welcome{
    public function Index(){
        $this->data['wax_price'] = $this->GetWaxPrice();
        $this->data['btk_price'] = $this->GetBTKPrice();
        $this->data['btk_pps'] = $this->GetBtkPPSPrivate();
        $this->data['server_cost_donations'] = $this->GetServerCostDonations();
        
        return 'index';
    }

    public function Test(){
        $this->data['wax_price'] = $this->GetWaxPrice();
        $this->data['btk_price'] = $this->GetBTKPrice();
        $this->data['btk_pps'] = $this->GetBtkPPSPrivate();
        $this->data['server_cost_donations'] = $this->GetServerCostDonations();
        
        return 'test';
    }

    private function GetServerCostDonations(){
        return 80;
    }

    public function GetBtkPPS(){
        echo $this->GetBtkPPSPrivate();
    }

    public function GetTokenPoolInfo(){
        $data = array(
            'scope' => 'miningntwrkc',
            'limit' => 10,
            'table' => 'config',
            'code' => 'miningntwrkc',
            'json' => true
        );

        $json = json_encode($data);

        $url = 'https://wax.eosn.io/v1/chain/get_table_rows';

        $ch = curl_init($url); 
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);

        $result_data = json_decode($result,true);

        $shares_pool = $result_data['rows'][0]['shares_pool'];
        $token_pool = $result_data['rows'][0]['tokens_pool'];
        
        echo "Shares Pool: {$shares_pool}<br>";
        echo "Tokens Pool: {$token_pool}<br>";

        $btk_pps = $token_pool/$shares_pool;

        echo "BTK PPS: {$btk_pps}";

        echo "<pre>";
        print_r($result_data['rows'][0]);
        echo "</pre>";

    }

    private function GetBtkPPSPrivate(){
        $data = array(
            'scope' => 'miningntwrkc',
            'limit' => 10,
            'table' => 'config',
            'code' => 'miningntwrkc',
            'json' => true
        );

        $json = json_encode($data);

        $url = 'https://wax.eosn.io/v1/chain/get_table_rows';

        $ch = curl_init($url); 
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);

        $result_data = json_decode($result,true);

        $shares_pool = $result_data['rows'][0]['shares_pool'];
        $token_pool = $result_data['rows'][0]['tokens_pool'];
        
        return ($token_pool/$shares_pool);
    }

    public function GetBitcakePrice(){
        echo $this->GetBTKPrice();
    }

    private function GetBTKPrice(){
        $content = file_get_contents('https://alcor.exchange/api/markets/518');

        $data = json_decode($content,true);

        return $data['last_price'];
    }

    public function GetWaxPrice(){
        $url = 'https://api.coingecko.com/api/v3/coins/wax';

        $headers = [
            'Accepts: application/json'
        ];
  
        $curl = curl_init(); // Get cURL resource
        // Set cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,            // set the request URL
            CURLOPT_HTTPHEADER => $headers,     // set the headers 
            CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
        ));

        $response = json_encode(curl_exec($curl)); // Send the request, save the response
        curl_close($curl); // Close request

        $data = json_decode(json_decode($response,true),true);

        return $data['market_data']['current_price']['usd'];
    }

    public function GetWaxPriceBackup(){
        $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest';
        
        $parameters = [
          'id' => '2300'
        ];

        $headers = [
          'Accepts: application/json',
          'X-CMC_PRO_API_KEY: 3014d6d5-18fd-4223-88cd-e94cc0281e09'
        ];

        $qs = http_build_query($parameters); // query string encode the parameters
        $request = "{$url}?{$qs}"; // create the request URL

        $curl = curl_init(); // Get cURL resource
        // Set cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $request,            // set the request URL
            CURLOPT_HTTPHEADER => $headers,     // set the headers 
            CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
        ));

        $response = json_encode(curl_exec($curl)); // Send the request, save the response
        curl_close($curl); // Close request

        $data = json_decode(json_decode($response,true),true);

        return $data['data']['2300']['quote']['USD']['price'];
    }
}
?>
