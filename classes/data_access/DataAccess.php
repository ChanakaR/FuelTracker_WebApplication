<?php

/**
 * Created by PhpStorm.
 * User: bmCSoft
 * Date: 2016-05-21
 * Time: 9:40 AM
 */
class DataAccess
{
    private $url = "http://localhost/FTApplicationServer/requestHandler.php";
    private $curl;

    public function __construct()
    {

        $this->curl = curl_init($this->url);
    }

    /*
     *  close the curl connection
     */
    public function closeCurl(){
        curl_close($this->curl);
    }

    /*
     * selectData - select data from a particular table
     */
    public function selectData($json){
        $this->generateRequest($json,"POST");
        $response = curl_exec($this->curl);
        curl_close($this->curl);
        $response_array =  json_decode($response,true);
        return $response_array['message'];
    }
    /*
     * queryData - select data from multiple table
     */
    public function queryData(){

    }

    /*
     * insertData - insert data into table
     */
    public function insertData($json){
        $this->generateRequest($json,"POST");
        $response = curl_exec($this->curl);
        curl_close($this->curl);

        return $response;
    }

    /*
     * update data of a table
     */
    public function updateData($json){
        $this->generateRequest($json,"PUT");
        $response = curl_exec($this->curl);
        curl_close($this->curl);
        echo $response;
    }

    /*
     * delete data from a table
     */
    public function deleteData($json){
        $this->generateRequest($json,"DELETE");
        $response = curl_exec($this->curl);
        curl_close($this->curl);
        echo $response;
    }

    private function generateRequest($json,$method){

        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $json);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($json))
        );
    }
}