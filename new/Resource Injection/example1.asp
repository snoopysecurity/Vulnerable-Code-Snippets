int rPort = Int32.Parse(Request.get_Item("remotePort "));
IPEndPoint endpoint = new IPEndPoint(address,rPort);
socket = new Socket(endpoint.AddressFamily, 
SocketType.Stream, ProtocolType.Tcp);
socket.Connect(endpoint);
