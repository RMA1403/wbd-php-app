<?php

class PostSubscribeController
{
  public function call() {
    $xml = '<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tns="http://services.soapserver/">
              <soap:Header>
                <tns:apiKey>ularmelingkardiataspagar</tns:apiKey>
              </soap:Header>
              <soap:Body>
                <tns:addSubscription>
                  <idUser>8</idUser>
                </tns:addSubscription>
              </soap:Body>
            </soap:Envelope>';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://tubes-soap-service:8000/subscription");
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      "Content-type: text/xml;charset=\"utf-8\"",
      "Accept: text/xml",
      "Cache-Control: no-cache",
      "Pragma: no-cache",
      "SOAPAction: http://soapserver/SubscriptionService/addSubscriptionRequest", 
      "Content-length: ".strlen($xml)
    ]);
    curl_setopt(
      $ch,
      CURLOPT_POSTFIELDS,
      $xml
    );
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $output = curl_exec($ch);
    curl_close($ch);

    http_response_code(201);
    header('Content-type: application/json');
    echo json_encode(["message" => "success"]);

    exit;
  }
}