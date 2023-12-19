import express from 'express';
import { createServer } from 'http';
import { Server } from 'socket.io';

const app = express();
const server = createServer(app);
const io = new Server(server, {
    cors: { origin: "*" }
});

io.on('connection', (socket) => {
    console.log('connection');

    socket.on('sendChatToServer', (message) => {
        console.log(message);

        // io.sockets.emit('sendChatToClient', message);
        socket.broadcast.emit('sendChatToClient', message);
    });

    //-------------------------------------------------------
    //-------------------------------------------------------
    //-------------------------------------------------------
    // Listen for a user joining a private channel
    socket.on('joinPrivateChannel', (userId) => {
        // Join a room specific to the user
        socket.join(`user_${userId}`);
        console.log(`User ${userId} joined private channel`);
    });

    // Listen for messages from the client
    socket.on('sendPrivateChatToServer', (data) => {
        const { userId, message } = data;
        console.log(`Received message from user ${userId}: ${message}`);

        // Broadcast the message to the specific user's room
        io.to(`user_${userId}`).emit('sendPrivateChatToClient', message);
    });
    //-------------------------------------------------------
    //-------------------------------------------------------
    //-------------------------------------------------------

    socket.on('disconnect', () => {
        console.log('Disconnect');
    });
});

const PORT = 3000;
server.listen(PORT, () => {
    console.log('Server is running');
});
