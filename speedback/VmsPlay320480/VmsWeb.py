#pip install paho-mqtt
import requests
import paho.mqtt.client as mqtt
import json
import time

def ReadConfig():
    global UrlTF
    global UrlMedia
    global UrlMediaRoute
    global UrlTfUserName
    global UrlTfPassWord
    global MQttServerIP
    global MQttServerPort 
    global MQttServerUserName 
    global MQttServerUserPassword
    global VmsCode
    global WssCode
    f = open("Config.json", "r")
    DataCfg=f.read()
    f.close()
    ObjCfg = json.loads(DataCfg)
   
    UrlTF=ObjCfg["UrlTF"]
    UrlMedia=ObjCfg["UrlMedia"]
    UrlMediaRoute=ObjCfg["UrlMediaRoute"]
    print(UrlMedia)
    print(UrlMediaRoute)
    UrlTfUserName=ObjCfg["UrlTfUserName"]
    UrlTfPassWord=ObjCfg["UrlTfPassWord"]
    MQttServerIP=ObjCfg["MQttServerIP"]
    MQttServerPort=ObjCfg["MQttServerPort"] 
    MQttServerUserName=ObjCfg["MQttServerUserName"] 
    MQttServerUserPassword=ObjCfg["MQttServerUserPassword"]
    VmsCode=ObjCfg["VmsCode"]
    WssCode=ObjCfg["WssCode"]
    print(UrlTF)
    print(UrlTfUserName)
    print(UrlTfPassWord)
    print(MQttServerIP)
    print(MQttServerPort)
    print(MQttServerUserName)
    print(MQttServerUserPassword)
ReadConfig()

def DownLoadJson(UrlTF,UrlMedia,UrlTfUserName,UrlTfPassWord,VmsCode):
    print("StartDownloadMedia")
    try:
         dat={
               'DownLoadVmsPlay': 'DownLoadVmsPlay',
               'VmsCode':VmsCode
         }
         print(UrlTF)
         r = requests.post(UrlTF, data=dat,auth=(UrlTfUserName,UrlTfPassWord))
         print(r.status_code)
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
                           FilePath="C:\\inetpub\\wwwroot\\EVA\\VmsPlay320480\\img\\"+x["XVFileName"]
                           print(FilePath)
                           f = open(FilePath, "wb")
                           f.write(r.content)
                           f.close()
          
    except:
        print("Error Send Data")   
        return False
def DownLoadMedia(UrlTF,UrlMediaRoute,UrlTfUserName,UrlTfPassWord,VmsCode):
    print("StartDownloadMediaRout")
    try:
         dat={
               'DownLoadVmsPlay320480': 'DownLoadVmsPlay320480',
               'VmsCode':VmsCode
         }
         print(UrlTF)
         r = requests.post(UrlTF, data=dat,auth=(UrlTfUserName,UrlTfPassWord))
         print(r.status_code)
         if r.status_code==200:
            Obj = json.loads(r.text)
            
            if len(Obj)>0:
               f = open("MediaRout.json", "w")
               f.write(r.text)
               f.close()
               for x in  Obj:
                   
                       VMSCODE=x["XVVmsCode"]
                      
                       url_=UrlMediaRoute+"/"+VMSCODE+"/"+x["XVFileMap"]
                       print(url_)
                       r = requests.get(url_)
                       print(r.status_code)
                       if r.status_code==200:
                           print(url_)
                           FilePath="C:\\inetpub\\wwwroot\\EVA\\VmsPlay320480\\img\\"+x["XVFileMap"]
                           print(FilePath)
                           f = open(FilePath, "wb")
                           f.write(r.content)
                           f.close()
                       url_=UrlMediaRoute+"/"+VMSCODE+"/"+x["XVFileLogo"]
                       print(url_)
                       r = requests.get(url_)
                       print(r.status_code)
                       if r.status_code==200:
                           print(url_)
                           FilePath="C:\\inetpub\\wwwroot\\EVA\\VmsPlay320480\\img\\"+x["XVFileLogo"]
                           print(FilePath)
                           f = open(FilePath, "wb")
                           f.write(r.content)
                           f.close()
                           
                           
           
    except:
        print("Error Send Data")   
        return False       
def DownLoadTemplateLabel(UrlTF,UrlMedia,UrlTfUserName,UrlTfPassWord,VmsCode):
    print("StartDownloadLabel")
    print(VmsCode)
    try:
         dat={
               'DownLoadTemplateLabel': 'DownLoadTemplateLabel',
               'VmsCode':VmsCode
         }
         print(UrlTF)
         r = requests.post(UrlTF, data=dat,auth=(UrlTfUserName,UrlTfPassWord))
         print(r.status_code)
         if r.status_code==200:
       
            print(r.text)
            
            Obj = json.loads(r.text)
            if len(Obj)>0:
               f = open("Label.json", "w")
               f.write(r.text)
               f.close()
               
            return True
         else:
            return False
    except:
         print("Error Send Data")   
         return False             
def GetRouteXY(VmsCode):
    print("StartGetRouteXY")
    print(VmsCode)
    try:
         dat={
               'GetRouteXY': 'GetRouteXY',
               'VmsCode':VmsCode
         }
         print(UrlTF)
         r = requests.post(UrlTF, data=dat,auth=(UrlTfUserName,UrlTfPassWord))
         print(r.status_code)
         print()
         if r.status_code==200:
            print(r.text)
            Obj = json.loads(r.text)
            if len(Obj)>0:
               f = open("RouteXY.json", "w")
               f.write(r.text)
               f.close()
               
            return True
         else:
            return False
    except:
         print("Error Send Data")   
         return False    
def GetWeather(WssCode):
    print("StartWeatherSensor")
    print(VmsCode)
    try:
         dat={
               'GetWeatherSensor': 'GetWeatherSensor',
               'WssCode':WssCode
         }
         print(UrlTF)
         r = requests.post(UrlTF, data=dat,auth=(UrlTfUserName,UrlTfPassWord))
         print(r.status_code)
         print()
         if r.status_code==200:
       
            print(r.text)
            
            Obj = json.loads(r.text)
            if len(Obj)>0:
               f = open("WeatherSensor.json", "w")
               f.write(r.text)
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
    client.subscribe("VMS/"+VmsCode+"/#")
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
       
       #topic = topic.split("/")
       #NodeCode=topic[1]
       #print(NodeCode)
       
       jsonobj = json.loads(strjson)
       
       Command=jsonobj["Command"]
       if Command==1:
           DownLoadJson(UrlTF,UrlMedia,UrlTfUserName,UrlTfPassWord,VmsCode)
           DownLoadTemplateLabel(UrlTF,UrlMedia,UrlTfUserName,UrlTfPassWord,VmsCode)
           DownLoadMedia(UrlTF,UrlMediaRoute,UrlTfUserName,UrlTfPassWord,VmsCode)
           GetWeather(WssCode)
           GetRouteXY(VmsCode)
           f = open("Relaod.cmd", "w")
           f.write('Reload')
           f.close()
       if Command==2:
           DownLoadTemplateLabel(UrlTF,UrlMedia,UrlTfUserName,UrlTfPassWord,VmsCode)
           GetWeather(WssCode)
           GetRouteXY(VmsCode)
           f = open("Relaod.cmd", "w")
           f.write('Reload')
           f.close()
       
          
   except:
        print("Error Data")   
        return False

client = mqtt.Client()
client.on_disconnect = on_disconnect
client.on_connect = on_connect
client.on_message = on_message
client.username_pw_set(MQttServerUserName, MQttServerUserPassword)



while True:
    rc = client.loop()
    if rc != 0:
        try:
            time.sleep(1)
            print("Begin Connect Mqtt")
            client.connect(MQttServerIP, int(MQttServerPort), 10)            
        except:
            pass
