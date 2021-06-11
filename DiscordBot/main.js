const Discord = require('discord.js');
var mysql = require('mysql')

var token = 'token'
var admindiscordid = 'admindiscordid'




var con = mysql.createConnection({
    host:"localhost",
    user:"root",
    password:"",
    database:"whitelist"
})
con.connect()

const client = new Discord.Client();




client.once('ready', () => {
    console.log('Bot is online!');

});

function randomkey(l) {
    var crypto = require("crypto");
    var id = crypto.randomBytes(l).toString('hex');

    return id
}

function getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min)) + min;
}


client.on("message", message => {
    let msgArray = message.content.split(" ");
    let prefix = "!";
    let cmd = msgArray[0].replace(prefix, "");
    var command = cmd.toLowerCase()
    let args = msgArray.slice(1);


    if(message.channel.type === "dm"){
        if(message.author.id == admindiscordid) {
            if(command === "createkey" || command === "ck") {
                if(!args[0]) return message.channel.send("Please specify a key.");
                if(args[1]) return message.channel.send("Too many arguments.");
          
                  con.query("INSERT INTO `keys` (`keys`) VALUES" + "('" + args[0] + "')",function(err,result){
          
                      console.log(" 1 key added!")
                  })
          
                  message.author.send('Created key = ' + args[0]);
              }
              if(command === "createrandomkey" || command === "crk" || command === "baka") {
                    var lol = randomkey(getRandomInt(20,100))
                    con.query("INSERT INTO `keys` (`keys`) VALUES" + "('" + lol + "')",function(err,result){
            
                        console.log(" 1 key added! == " + lol )
                        message.author.send('Created Random key = ' + lol);
                    })
                }
    
                if(command === "deleteallkeys" || command === "dkah") {
            
                      con.query("DELETE FROM `keys` LIMIT 100000",function(err,result){
              
                          console.log(" All keys Deleted!")
                          message.author.send('Deleted all keys');
                      
                    })
                  }


                  if(command === "deleteallhwids" || command === "dahwid") {
            
                    con.query("DELETE FROM hwid ORDER BY hwid LIMIT 100000",function(err,result){
            
                        console.log(" All hwids Deleted!")
                        message.author.send('Deleted all hwids');
                    
                  })
                }


    
                  if(command === "help") {
                  message.author.send('!CreateKey --key--   to create a key! \n!CreateRandomKey to create a random Key! \n!DeleteAllKeys to delete all keys! \n!DeleteAllHWIDS to delete all HWIDs');

                }
        
            }


    }



  });





client.login(token)