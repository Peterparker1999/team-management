#include <TinyGPS++.h>
#include <SoftwareSerial.h>
TinyGPSPlus NEO_6M_GPS;
SoftwareSerial gps(10, 8);
SoftwareSerial sim(5, 3);
char resL;
char resDT;
int button1 = 9;
int button2 = 12;
int button1_state = 0;
int button2_state = 0;
float Latitude;
float Longitude;
int Day;
int Month;
int Year;
int Hour;
int Minute;
int Second;
void GPS_data()
{
  if (NEO_6M_GPS.location.isValid())
  {
    Serial.print("Latitude= ");
    Serial.println(NEO_6M_GPS.location.lat(), 6);
    Latitude  = (NEO_6M_GPS.location.lat(), 6);
    Serial.print(" Longitude= ");
    Serial.println(NEO_6M_GPS.location.lng(), 6);
    Longitude = (NEO_6M_GPS.location.lng(), 6);
  }
}
void GPS_time()
{
  if (NEO_6M_GPS.location.isValid())
  {
    Serial.print("Year = ");
    Serial.println(NEO_6M_GPS.date.year());
    Year = (NEO_6M_GPS.date.year());
    Serial.print("Month = ");
    Serial.println(NEO_6M_GPS.date.month());
    Month = (NEO_6M_GPS.date.month());
    Serial.print("Day = ");
    Serial.println(NEO_6M_GPS.date.day());
    Day = (NEO_6M_GPS.date.day());
    Serial.print("Hour = ");
    Serial.println(NEO_6M_GPS.time.hour());
    Hour = (NEO_6M_GPS.time.hour());
    Serial.print("Minute = ");
    Serial.println(NEO_6M_GPS.time.minute());
    Minute = (NEO_6M_GPS.time.minute());
    Serial.print("Second = ");
    Serial.println(NEO_6M_GPS.time.second());
    Second = (NEO_6M_GPS.time.second());
  }
}
void sms_M()
{

  sim.print("HELP, I NEED HELP. Here are my coordinates");
  sim.write(26);
}
void sms_gps()
{
  sim.print("Latitude = ");
  updateSerial();
  sim.write(26);
  sim.println(Latitude);
  updateSerial();
  sim.write(26);
  sim.print("Longitude = ");
  updateSerial();
  sim.write(26);
  sim.println(Longitude);
  updateSerial();
  sim.write(26);
}
void sms_dt()
{
  sim.print("date = ");
  updateSerial();
  sim.write(26);
  sim.println(Day);
  updateSerial();
  sim.write(26);
  sim.println(Month);
  updateSerial();
  sim.write(26);
  sim.println(Year);
  updateSerial();
  sim.write(26);
  sim.print("time = ");
  updateSerial();
  sim.write(26);
  sim.println(Hour);
  updateSerial();
  sim.write(26);
  sim.print(".");
  updateSerial();
  sim.write(26);
  sim.println(Minute);
  updateSerial();
  sim.write(26);
  sim.print(".");
  updateSerial();
  sim.write(26);
  sim.println(Second);
  updateSerial();
  sim.write(26);
}
void Location()
{
  Serial.print("Latitude= ");
  Serial.print("28.618631");
  sim.print("Latitude= ");
  updateSerial();
  sim.write(26);
  sim.print("28.618631");
  updateSerial();
  sim.write(26);
  Serial.print(" Longitude= ");
  Serial.println("77.302549");
  sim.print(" Longitude= ");
  updateSerial();
  sim.write(26);
  sim.print("77.302549");
  updateSerial();
  sim.write(26);
}
void sim_location()
{
  sim.listen();
  resL = sim.println("AT+CIPGSMLOC=1,1");
  Serial.print("location of nearest tower= ");
  sim.println(resL);
  updateSerial();
  sim.println(26);
  delay(700);
}
void sim_date()
{
  resDT = sim.println("AT+CCLK?");
  Serial.println("time= ");

  sim.println(resDT);
  updateSerial();
  sim.println(26);
}
void serial_M_gps_dt()
{
  Serial.println("HELP, I NEED HELP. Here are my coordinates");
  Serial.println("Latitude = ");
  Serial.println(Latitude);
  Serial.println("Longitude = ");
  Serial.println(Longitude);
  Serial.println("date = ");
  Serial.println(Day);
  Serial.println(Month);
  Serial.println(Year);
  Serial.println("time = ");
  Serial.println(Hour);
  Serial.println(".");
  Serial.println(Minute);
  Serial.println(".");
  Serial.println(Second);
}
void updateSerial()
{
  delay(500);
  while (Serial.available())
  {
    sim.write(Serial.read());//Forward what Serial received to Software Serial Port
  }
  while (sim.available())
  {
    Serial.write(sim.read());//Forward what Software Serial received to Serial Port
  }
}

void setup()
{
  pinMode(button1, INPUT);
  pinMode(button2, INPUT);
  Serial.begin(9600);
  Serial.println("Initializing...");
  gps.begin(9600);
  gps.listen();
  while (!Serial.available())
  {
  }
  sim.begin(9600);
  sim.listen();
//  while (!Serial.available())
//  {
//  }
  sim.println("AT"); //basic command
  updateSerial();
  sim.println("AT+CMGF=1"); //sms format
  updateSerial();
  sim.println("AT+CSQ"); //signal strength
  updateSerial();
  sim.println("AT+CCID"); //sim card number
  updateSerial();
  sim.println("AT+CREG?"); //network regst
  updateSerial();
  sim.println("AT+CMGS=\"+919990034880\""); //sms send no.
  updateSerial();
  sim.print("AT+CBS"); //battery info
  updateSerial();
  gps.listen();
  gps.begin(9600);
}



void loop()
{
  gps.listen();
  button1_state = digitalRead(button1);
  button2_state = digitalRead(button2);
  if (button1_state == HIGH)
  {
    if (gps.available() > 0)
    {
      delay(1000);
      if (NEO_6M_GPS.encode(gps.read()))
      {
        Serial.println("Storing GPS data");
        GPS_data();
        GPS_time();
        serial_M_gps_dt();
        delay(1000);
        sim.listen();
        if (sim.available() > 0)
        {
          sms_M();
          sms_gps();
          sms_dt();
          delay(1000);
        }
      }
    }

    else if (!gps.available() && sim.available() > 0)
    {
      sim.listen();
      sim_location();
      sim_date();

    }
  }
  else if (button2_state == HIGH)
  {
    Location();
  }
}
