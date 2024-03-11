import socket
import json
from time import sleep

def ping():
    ip = "127.0.0.1"
    port = 9876

    server = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    try: 
        server.connect((ip, port))
        server.sendall("pull".encode())
        response = server.recv(256).decode()
        print(f"Server response: {response}")
    except ConnectionRefusedError: 
        print("Error connecting to server")
    finally:
        server.close()

def main():

    while True:
        input("Press enter to send request\n")
        ping()

        sleep(1)
        with open("displaycourse.json", "r") as file:
            data = json.load(file)
            print(data)

        print("\n")

if __name__ == "__main__":
    main()
