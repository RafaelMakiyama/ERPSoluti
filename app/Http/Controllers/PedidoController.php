<?php

namespace App\Http\Controllers;

use App\Http\Resources\PedidoCollection;
use App\Http\Resources\PedidoResource;
use App\Models\Historico;
use App\Models\Pedido;
use App\Models\Unidade;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Self_;

class PedidoController extends Controller
{
    const BASE_URL = "https://arcondicionadohom.acsoluti.com.br";
    const HMAC_VERSION = 1;
    const CLIENTID = 0;
    const WEBSERVICEKEY = "SijFebtuWushJik6";
    const VIDEOCONFERENCIAKEY = "JuwudJecOafbuId7";
    
    public function getPedido($pedidoId){

        $pedido = Pedido::where('codigo', '=', $pedidoId)->first();

        if(!$pedido){              
        return [
            'erros' => [[
                    'codigo' => 4,
                    'mensagem' => 'Pedido NAO AAAAAAAAAAAAAAAAAAAA' 
                    // DA FORMA QUE ELE QUER EXIBIR NOS SISAR
                ]],
            ];
        }    
        return new PedidoResource($pedido);
    }

    public function exportarPedido(Request $request){

        $historico = Historico::create([
            'json'=> $request->input('produtos'),
        ]);

        $historico = Historico::create([
            'json'=> $request->input('pedido')
        ]);

        return response()->json([
            'status' => 'OK'
        ]);
    }

    public function consultaDadosSolicitacao(Request $request){

        $uri = self::BASE_URL. "/webservice-api/consulta-situacao-solicitacao";
        $method = 'POST';

        $mensagem = array(
            "dataInicial" => "2020-06-04",
            "voucher" => array(
                "00038636a010",
            )
        );

        $m = json_encode($mensagem);
        $ds = $this->getDS($uri, $m , $method);
       
        $hkey = $this->getHkey();
        ddd($ds);
        $hmac = $this->getHMAC($hkey, $ds);

        $header = [
            'HMAC-Authentication' => self::HMAC_VERSION . ':' . self::CLIENTID. ':' . time() . ':' .$hmac,
        ];

        $client = new \GuzzleHttp\Client(['headers'=> $header,
            'base_uri' => $uri,
        ]);            
        
        $request = $client->post( $uri, ['json' => $mensagem] );
        echo $request->getBody();
    }

    public function importarAgendamento(){
        $uri = self::BASE_URL. "/videoconferencia-api/importar-pedido";
        $method = 'POST';

        $mensagem = [
            "pedido"  => "000323608240",
        ];

        $m = json_encode($mensagem);
        $ds = $this->getDS($uri, $m , $method);
        
        $hkey = $this->getHkeyVideoconferencia();
        $hmac = $this->getHMAC($hkey, $ds);
        
        $header = [
            'Content-type' => 'application/json',
            'HMAC-Authentication' => self::HMAC_VERSION . ':' . self::CLIENTID. ':' . time() . ':' .$hmac,
        ];
        
        $client = new \GuzzleHttp\Client(['headers'=> $header,
            'base_uri' => $uri,
        ]);  
        
        $request = $client->post( $uri, ['json' => $mensagem] );
        echo $request->getBody();
    }

    public function newRequest(){
        $uri = self::BASE_URL. "/videoconferencia-api/nova-solicitacao";
        $method = 'POST';

        $mensagem = array(
            'pedido'  => '000323608240',
            'cliente' => array(
                'nome' => 'Rafael Makiyama',
                'email' => 'rafael.makiyama@soluti.com.br',
                'telefone' => '11971087009',
                'cpf'=> '45590067847',
                'cnpj'=> '50974101060',
                'cnh'=> '',
                'senha' => 'Computador3@',
            ),
            'municipio' => array(
                'codigo' => '5208707'
            ),
            'produto' => array(
                    'idproduto' => 251,
                    'nome' => 'ACS PF A1 V5',
                    'tipo' => 'F',
                    'perfiliti' => 'A1 PF',
                    'validade' => 12,
                    'sequencia' => 1,
                    'isExtProdutoAc' => false,
                    'extProduto' => 9,
                    'extProdutoAc' => 0,
                    'campo1' => '17022021;17022021;VD',
                    'campo2' => null,
                    'campo3' => null
            ),
        );

        $m = json_encode($mensagem);
        $ds = $this->getDS($uri, $m , $method);
        
        $hkey = $this->getHkeyVideoconferencia();
        $hmac = $this->getHMAC($hkey, $ds);
        
        $header = [
            'Content-type' => 'application/json',
            'HMAC-Authentication' => self::HMAC_VERSION . ':' . self::CLIENTID. ':' . time() . ':' .$hmac,
        ];
        
        $client = new \GuzzleHttp\Client(['headers'=> $header,
            'base_uri' => $uri,
        ]);  
        
        $request = $client->post( $uri, ['json' => $mensagem] );
        echo $request->getBody();
    }

    public function availableHours(){
        $uri = self::BASE_URL. "/videoconferencia-api/horarios-disponiveis-videoconferencia";
        $method = 'POST';

        $mensagem = array(
            'dataAgendamento'  => '2021-11-18',
            'protocolo'=> '2324-39',
        );

        $m = json_encode($mensagem);
        $ds = $this->getDS($uri, $m , $method);
        
        $hkey = $this->getHkeyVideoconferencia();
        $hmac = $this->getHMAC($hkey, $ds);
        
        $header = [
            'Content-type' => 'application/json',
            'HMAC-Authentication' => self::HMAC_VERSION . ':' . self::CLIENTID. ':' . time() . ':' .$hmac,
        ];
        
        $client = new \GuzzleHttp\Client(['headers'=> $header,
            'base_uri' => $uri,
        ]);  
        
        $request = $client->post( $uri, ['json' => $mensagem] );
        echo $request->getBody();
    }

    public function scheduleVC(){

        $uri = self::BASE_URL. "/videoconferencia-api/agendar-videoconferencia";
        $method = 'POST';

        $mensagem = array(
            'dataHoraAgendamento'  => '2021-11-18 09:00',
            'protocolo'=> '2324-39',
            'senha'=> 'Computador3@'
        );

        $m = json_encode($mensagem);
        $ds = $this->getDS($uri, $m , $method);
        
        $hkey = $this->getHkeyVideoconferencia();
        $hmac = $this->getHMAC($hkey, $ds);
        
        $header = [
            'Content-type' => 'application/json',
            'HMAC-Authentication' => self::HMAC_VERSION . ':' . self::CLIENTID. ':' . time() . ':' .$hmac,
        ];
        
        $client = new \GuzzleHttp\Client(['headers'=> $header,
            'base_uri' => $uri,
        ]);  
        
        $request = $client->post( $uri, ['json' => $mensagem] );
        echo $request->getBody();

    }

    public function importDocuments(){ 
        
        $uri = self::BASE_URL. "/videoconferencia-api/importar-documentos";
        $method = 'POST';

        $mensagem = array(
            'protocolo'=> '2324-39',
            'senha'=> 'Computador3@',
            'docs' => array(
                'name' => 'RG',
                'extensao' => '.png',
                'file' => base64_encode(file_get_contents('/home/rafael/Imagens/1.png'))
            ),
        );

        $m = json_encode($mensagem);
        $ds = $this->getDS($uri, $m , $method);
        
        $hkey = $this->getHkeyVideoconferencia();
        $hmac = $this->getHMAC($hkey, $ds);
        
        $header = [
            'Content-type' => 'application/json',
            'HMAC-Authentication' => self::HMAC_VERSION . ':' . self::CLIENTID. ':' . time() . ':' .$hmac,
        ];
        
        $client = new \GuzzleHttp\Client(['headers'=> $header,
            'base_uri' => $uri,
        ]);  
        
        $request = $client->post( $uri, ['json' => $mensagem] );
        echo $request->getBody();
    }
    
    public function getDS($uri, $m, $method){
        $ds = $method . $uri . $m;
        return $ds;
    }

    public function getHkeyWebService(){
        $hkey = time() . self::WEBSERVICEKEY;
        return $hkey;
    }

    public function getHkeyVideoconferencia(){
        $hkey = time() . self::VIDEOCONFERENCIAKEY;
        return $hkey;
    }

    public function getHMAC($hkey, $ds){
        $hmac = hash('sha256', hash('sha256', $hkey) . hash('sha256', $hkey . $ds));
        return $hmac;
    }

}