const http = require ('http');

const hostname = '127.0.0.1';
port const = 3000;

serveur const = http.createServer ((req, res) => {
res.statusCode = 200;
res.setHeader ('Content-Type', 'text / plain');
res.end ('Bonjour de NodeJS \ n');
});

server.listen (port, nom d'hôte, () => {
console.log (`Serveur s'exécutant sur http: // $ {hostname}: $ {port} /`);
});
