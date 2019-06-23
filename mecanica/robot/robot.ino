#include <Servo.h>
#include <Ultrasonic.h>

#define pino_trigger 8 //verde
#define pino_echo 9 //amarelo

const int pinoOut = 11; //PINO DIGITAL UTILIZADO PELO MÓDULO

Ultrasonic ultrasonic(pino_trigger, pino_echo);
int IN1 = 4;
int IN2 = 5;
int IN3 = 6;
int IN4 = 7;

void verpare()
{
  float cmMsec, inMsec;
  long microsec = ultrasonic.timing();
  Serial.println ("recuar"); //IMPRIME O TEXTO NO MONITOR SERIAL
 digitalWrite(IN1, HIGH);
   digitalWrite(IN2, LOW);
   digitalWrite(IN3, LOW);
   digitalWrite(IN4, HIGH);   
  delay(800);
  Serial.println ("Virar");
   digitalWrite(IN1, LOW);
   digitalWrite(IN2, HIGH);
   digitalWrite(IN3, LOW);
   digitalWrite(IN4, HIGH);
   delay(1000);
  
  cmMsec = ultrasonic.convert(microsec, Ultrasonic::CM);
  
  if(digitalRead(pinoOut) == HIGH || cmMsec < 15){ //SE LEITURA DO PINO FOR IGUAL A HIGH (1) ou distância do obstáculo for menor que 15 cm    
    verpare();
  }
  else
  { //SENÃO, FAZ
    Serial.println ("Siga"); //IMPRIME O TEXTO NO MONITOR SERIAL    
  }

  
}

void setup()
{
  //Define os pinos como saida
 pinMode(IN1, OUTPUT);
 pinMode(IN2, OUTPUT);
 pinMode(IN3, OUTPUT);
 pinMode(IN4, OUTPUT);
 pinMode(pinoOut, INPUT); //DEFINE O PINO COMO ENTRADA
 Serial.begin (9600); //INICIALIZA A SERIAL
}
  
void loop()
{
 float cmMsec, conf;
 long microsec = ultrasonic.timing();
 cmMsec = ultrasonic.convert(microsec, Ultrasonic::CM); 

 //delay(1000);
  if(digitalRead(pinoOut) == HIGH || cmMsec < 15){ //SE LEITURA DO PINO FOR IGUAL A LOW, FAZ
    digitalWrite(IN1, HIGH);
   digitalWrite(IN2, HIGH);
   digitalWrite(IN3, HIGH);
   digitalWrite(IN4, HIGH);
    verpare();
  }
  else{ //SENÃO, FAZ
    Serial.println ("siga"); //IMPRIME O TEXTO NO MONITOR SERIAL
    digitalWrite(IN1, LOW);
   digitalWrite(IN2, HIGH);
   digitalWrite(IN3, HIGH);
   digitalWrite(IN4, LOW);
   delay(50);
  }

 
 /*//Gira o Motor A no sentido horario
 digitalWrite(IN1, HIGH);
 digitalWrite(IN2, LOW);
 delay(2000);
 //Para o motor A
 digitalWrite(IN1, HIGH);
 digitalWrite(IN2, HIGH);
 delay(500);
 //Gira o Motor B no sentido horario
 digitalWrite(IN3, HIGH);
 digitalWrite(IN4, LOW);
 delay(2000);
 //Para o motor B
 digitalWrite(IN3, HIGH);
 digitalWrite(IN4, HIGH);
 delay(500);
 
 //Gira o Motor A no sentido anti-horario
 digitalWrite(IN1, LOW);
 digitalWrite(IN2, HIGH);
 delay(2000);
 //Para o motor A
 digitalWrite(IN1, HIGH);
 digitalWrite(IN2, HIGH);
 delay(500);
 //Gira o Motor B no sentido anti-horario
 digitalWrite(IN3, LOW);
 digitalWrite(IN4, HIGH);
 delay(2000);
 //Para o motor B
 digitalWrite(IN3, HIGH);
 digitalWrite(IN4, HIGH);
 delay(500)*/
}
