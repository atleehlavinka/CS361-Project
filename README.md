To request data from the microservice:
Ping the port specified at the top of microservice.php with the message "pull".

    Example code (in php):

        $port = 9876;
        $socket = stream_socket_client("tcp://127.0.0.1:$port", $errno, $errstr);

        if (!$socket) {
            echo "Error starting client: $errstr\n";
        }

        fwrite($socket, "pull");
        fclose($socket)

To receive data from the microservice:
Data will be stored in the file specified in microservice.php under $filename as a JSON

    Example JSON:

        {id: int,
        Course Name: str,
        Description: str,
        Instructor: str,
        Date: date,
        Price: float}

UML:

Website     JSON file     Microservice     Database
   |        ----pull---->       |              |
   |             |              |  --query-->  | 
   |             |  <--write--  |              |
   |  <--read--  |              |              |  
