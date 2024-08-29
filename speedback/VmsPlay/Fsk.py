#pip install paho-mqtt
import requests
import paho.mqtt.client as mqtt
import json
import time
def ReadConfig():
    global UrlTF
    global UrlMedia
    global UrlTfUserName
    global UrlTfPassWord
    global MQttServerIP
    global MQttServerPort 
    global MQttServerUserName 
    global MQttServerUserPassword
    f = open("Config.json", "r")
    DataCfg=f.read()
    f.close()
    ObjCfg = json.loads(DataCfg)
   
    UrlTF=ObjCfg["UrlTF"]
    UrlMedia=ObjCfg["UrlMedia"]
    UrlTfUserName=ObjCfg["UrlTfUserName"]
    UrlTfPassWord=ObjCfg["UrlTfPassWord"]
    MQttServerIP=ObjCfg["MQttServerIP"]
    MQttServerPort=ObjCfg["MQttServerPort"] 
    MQttServerUserName=ObjCfg["MQttServerUserName"] 
    MQttServerUserPassword=ObjCfg["MQttServerUserPassword"] 
    print(UrlTF)
    print(UrlTfUserName)
    print(UrlTfPassWord)
    print(MQttServerIP)
    print(MQttServerPort)
    print(MQttServerUserName)
    print(MQttServerUserPassword)
ReadConfig()

def DownLoadJson(UrlTF,UrlMedia,UrlTfUserName,UrlTfPassWord,VmsCode):
    
    try:
         dat={
               'DownLoadVmsPlay': 'DownLoadVmsPlay',
               'VmsCode':VmsCode
         }
         r = requests.post(UrlTF, data=dat,auth=(UrlTfUserName,UrlTfPassWord))
         if r.status_code==200:
            Obj = json.loads(r.text)
            if len(Obj)>0:
               f = open("Media.json", "w")
               f.write(r.text)
               f.close()
               for x in  Obj:
                   #print(x["XVMediaType"])
                   if x["XVMediaType"]>1:
                       PrjCode=x["XVPrjCode"]
                       print(PrjCode)
                       url_=UrlMedia+"/"+PrjCode+"/"+x["XVFileName"]
                       print(url_)
                    
                       r = requests.get(url_)
                       print(r.status_code)
                       if r.status_code==200:
                           print(url_)
                           FilePath="IMG/"+x["XVFileName"]
                           f = open(FilePath, "wb")
                           f.write(r.content)
                           f.close()
            return True
         else:
            return False
    except:
        print("Error Send Data")   
        return False
       
             
    
def on_disconnect(client, userdata, rc):
    if rc != 0:
        print("Unexpected disconnection.")
def on_connect(client, userdata, flags, rc):
    print("Connected with result code "+str(rc))
    client.subscribe("BRI/#")
def CkNumber(Num):
    ret=0
    try: 
       if Num.isnumeric()==True:
         ret=Num
    except:
        pass
    return ret    


            
        
def on_message(client, userdata, msg):
   try:   
       strjson=str(msg.payload, 'UTF-8') 
       topic=msg.topic
       
       topic = topic.split("/")
       NodeCode=topic[1]
       print(NodeCode)
       jsonobj = json.loads(msg.payload)
      
       NodeID=jsonobj["nodeID"]
       Voltage=jsonobj["voltage"]
       Current=jsonobj["current"]
       Power=jsonobj["power"]
       Energy=jsonobj["energy"]
          
   except:
        print("Error Data")   
        return False

client = mqtt.Client()
client.on_disconnect = on_disconnect
client.on_connect = on_connect
client.on_message = on_message
client.username_pw_set(MQttServerUserName, MQttServerUserPassword)
PrjCode='VMS23-00001'
DownLoadJson(UrlTF,UrlMedia,UrlTfUserName,UrlTfPassWord,PrjCode);
while True:
    rc = client.loop()
    if rc != 0:
        try:
            time.sleep(1)
            print("Begin Connect Mqtt")
            client.connect(MQttServerIP, int(MQttServerPort), 10)            
        except:
            pass
