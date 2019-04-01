from chatterbot import ChatBot
from chatterbot.trainers import ListTrainer
import os

oric = ChatBot("ORIC")

'''
conversa = [
        "Oi",
        "Olá!",
        "Tudo bem?",
        "Eu estou bem"
]
'''

trainer = ListTrainer(oric)
#trainer.train(conversa)

for arq in os.listdir('arq'):
    conversa = open('arq/' + arq, 'r').readlines()
    trainer.train(conversa)

while True:
    try:
        pergunta = input('Você: ')
        resposta = oric.get_response(pergunta)
        if float(resposta.confidence) > 0.5:
            print("Oric: ", resposta)
        else:
            print("Oric: Eu não sei")
         
    except (KeyboardInterrupt, EOFError, SystemExit):
        break

'''
while True:
    try:
        pergunta = oric.get_response(input())
        print(pergunta)
    except (KeyboardInterrupt, EOFError, SystemExit):
        break

while True:
   pergunta = input("Você: ")
   resposta = oric.get_response(pergunta)
   if float(resposta.confidence) > 0.5:
       print("Oric: ", resposta)
   else:
       print("Oric: Eu não sei")
'''
