<?php
namespace Controllers;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class ServerInfoController
{
   protected $container;
   protected $pdo;

   // constructor receives container instance
   public function __construct(ContainerInterface $container) {
       $this->container = $container;
       $this->pdo = $this->container->get("pdo");
   }

   public function list(Request $request, Response $response, array $args) {
    $data = json_decode('[{"id":"9991","hostname":"23.16.0.2","created":"2020-10-01 00:00:00","response":"c3817001001a016e0180a000050000003c540000010000001800000000000203010000005761726861776b000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000007000000c0a80009000000002d2798120100000000000000010000000000000000000000000000000000000000000000000000000000000000000000000000000280c400c0a800094e4f544943453a202870726573732010290000000000000000000000000000006d756c7469303100000000000000000000000000000000000b020201000401010600000c000000030026c36f63746636000000000000000000000000000a000000000014013205003c04c44000040000000000000000000000000000000000003fc000000000000200000985000000000000000000000000000000000000000000010006ffffffffffffffff0000000000000000000000000000000000000000","state":"online","ping":9999,"name":"NOTICE: (press ^)"},{"id":"9992","hostname":"23.16.0.3","created":"2020-10-01 00:00:00","response":"c3817001001a016e0180a000050000003c540000010000001800000000000203010000005761726861776b000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000007000000c0a80009000000002d2798120100000000000000010000000000000000000000000000000000000000000000000000000000000000000000000000000280c400c0a800094f6e6c696e65206d6f6465206973206261636b210000000000000000000000006d756c7469303100000000000000000000000000000000000b020201000401010600000c000000030026c36f63746636000000000000000000000000000a000000000014013205003c04c44000040000000000000000000000000000000000003fc000000000000200000985000000000000000000000000000000000000000000010006ffffffffffffffff0000000000000000000000000000000000000000","state":"online","ping":9999,"name":"Online mode is back!"},{"id":"9993","hostname":"23.16.0.4","created":"2020-10-01 00:00:00","response":"c3817001001a016e0180a000050000003c540000010000001800000000000203010000005761726861776b000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000007000000c0a80009000000002d2798120100000000000000010000000000000000000000000000000000000000000000000000000000000000000000000000000280c400c0a80009574542534954453a0000000000000000000000000000000000000000000000006d756c7469303100000000000000000000000000000000000b020201000401010600000c000000030026c36f63746636000000000000000000000000000a000000000014013205003c04c44000040000000000000000000000000000000000003fc000000000000200000985000000000000000000000000000000000000000000010006ffffffffffffffff0000000000000000000000000000000000000000","state":"online","ping":9999,"name":"WEBSITE:"},{"id":"9994","hostname":"23.16.0.5","created":"2020-10-01 00:00:00","response":"c3817001001a016e0180a000050000003c540000010000001800000000000203010000005761726861776b000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000007000000c0a80009000000002d2798120100000000000000010000000000000000000000000000000000000000000000000000000000000000000000000000000280c400c0a8000970736f6e652e6f6e6c696e652f777200000000000000000000000000000000006d756c7469303100000000000000000000000000000000000b020201000401010600000c000000030026c36f63746636000000000000000000000000000a000000000014013205003c04c44000040000000000000000000000000000000000003fc000000000000200000985000000000000000000000000000000000000000000010006ffffffffffffffff0000000000000000000000000000000000000000","state":"online","ping":9999,"name":"psone.online\\/wr"},{"id":"9995","hostname":"23.16.0.6","created":"2020-10-01 00:00:00","response":"c3817001001a016e0180a000050000003c540000010000001800000000000203010000005761726861776b000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000007000000c0a80009000000002d2798120100000000000000010000000000000000000000000000000000000000000000000000000000000000000000000000000280c400c0a800095741524e494e473a0000000000000000000000000000000000000000000000006d756c7469303100000000000000000000000000000000000b020201000401010600000c000000030026c36f63746636000000000000000000000000000a000000000014013205003c04c44000040000000000000000000000000000000000003fc000000000000200000985000000000000000000000000000000000000000000010006ffffffffffffffff0000000000000000000000000000000000000000","state":"online","ping":9999,"name":"WARNING:"},{"id":"9996","hostname":"23.16.0.7","created":"2020-10-01 00:00:00","response":"c3817001001a016e0180a000050000003c540000010000001800000000000203010000005761726861776b000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000007000000c0a80009000000002d2798120100000000000000010000000000000000000000000000000000000000000000000000000000000000000000000000000280c400c0a800094261636b757020796f75722073617665210000000000000000000000000000006d756c7469303100000000000000000000000000000000000b020201000401010600000c000000030026c36f63746636000000000000000000000000000a000000000014013205003c04c44000040000000000000000000000000000000000003fc000000000000200000985000000000000000000000000000000000000000000010006ffffffffffffffff0000000000000000000000000000000000000000","state":"online","ping":9999,"name":"Backup your save!"},{"id":"9997","hostname":"23.16.0.8","created":"2020-10-01 00:00:00","response":"c3817001001a016e0180a000050000003c540000010000001800000000000203010000005761726861776b000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000007000000c0a80009000000002d2798120100000000000000010000000000000000000000000000000000000000000000000000000000000000000000000000000280c400c0a80009536b696e732077696c6c206265207265736574210000000000000000000000006d756c7469303100000000000000000000000000000000000b020201000401010600000c000000030026c36f63746636000000000000000000000000000a000000000014013205003c04c44000040000000000000000000000000000000000003fc000000000000200000985000000000000000000000000000000000000000000010006ffffffffffffffff0000000000000000000000000000000000000000","state":"online","ping":9999,"name":"Skins will be reset!"},{"id":"9998","hostname":"23.16.0.2","created":"2020-10-01 00:00:00","response":"c3817001001a016e0180a000050000003c540000010000001800000000000203010000005761726861776b000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000007000000c0a80009000000002d2798120100000000000000010000000000000000000000000000000000000000000000000000000000000000000000000000000280c400c0a800094e4f544943453a202870726573732010290000000000000000000000000000006d756c7469303100000000000000000000000000000000000b020201000401010600000c000000030026c36f63746636000000000000000000000000000a000000000014013205003c04c44000040000000000000000000000000000000000003fc000000000000200000985000000000000000000000000000000000000000000010006ffffffffffffffff0000000000000000000000000000000000000000","state":"online","ping":9999,"name":"NOTICE: (press ^)"}]', true);
	foreach ($this->pdo->query("SELECT * FROM `server`;") as $row) {
            $data[] = [
                "id" => $row["id"],
                "hostname" => $row["hostname"],
                "created" => $row["created"],
                "response" => $row["last_packet"],
                "state" => $row["last_state"],
                "ping" => $row["last_ping"] + 0,
                "name" => $row["last_name"]
            ];
        }
        $response = $response->withStatus(200)->withJson($data);
        return $response;
   }


   public function checkForwarding(Request $request, Response $response, array $args) {
        $data = [
            "ip" => $_SERVER['REMOTE_ADDR'],
            "info" => $this->checkHost($_SERVER['REMOTE_ADDR'])
        ];
        $response = $response->withStatus(200)->withJson($data);
        return $response;
    }

    public function addHost(Request $request, Response $response, array $args) {
        $params = $request->getParsedBody();
        if(!isset($params["fcm_id"])) $params["fcm_id"] = null;
        $res = $this->checkHost($_SERVER['REMOTE_ADDR']);
        if($res["state"] == "online") {
            $stmt = $this->pdo->prepare("INSERT INTO `server` (`id`, `user`, `hostname`, `persistent`, `fcm_id`, `created`, `updated`, `last_state`, `last_ping`, `last_name`, `last_packet`) 
            VALUES (NULL, '0', ?, '0', ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, ?, ?, ?, ?);");
            $stmt->execute([$_SERVER['REMOTE_ADDR'], $params["fcm_id"], $res["state"], $res["ping"], $res["name"], $res["msg"]]);
            $data = [
                "state" => "ok",
                "info" => $res
            ];
        } else {
            $data = [
                "state" => "failed"
            ];
        }
        $response = $response->withStatus(200)->withJson($data);
        return $response;
    }

    private function checkHost($ip) {
        $port = 10029;
        // Discovery message
        $str = hex2bin("c381b800001900b6018094004654000005000000010000000000020307000000c0a814ac000000002d27000000000000010000005761726861776b000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000002801800ffffffff00000000000000004503d7e0000000000000005a");
        assert(strlen($str)==188);
        
        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP); 
        socket_set_option($sock, SOL_SOCKET, SO_BROADCAST, 1);
        socket_set_option($sock, SOL_SOCKET, SO_RCVTIMEO, array("sec"=>1, "usec"=>0));
        $start = (int)(microtime(TRUE)*1000);
        socket_sendto($sock, $str, strlen($str), 0, $ip, $port);
        
        $ret = @socket_recvfrom($sock, $buf, 1024, 0, $ip, $port);
        $time = (int)(microtime(TRUE)*1000) - $start;
        if($ret === false) return [
            "state"=>"offline"
        ];
        socket_close($sock);

        $name = trim(unpack("a32", substr($buf, 180, 32))[1]);

        return [
            "msg" => bin2hex($buf),
            "state" => "online",
            "ping" => $time,
            "name" => $name
        ];
    }
}