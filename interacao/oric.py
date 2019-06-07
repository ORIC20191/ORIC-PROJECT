# -*- coding: utf-8 -*-
from chatterbot import ChatBot
#from pymongo import MongoClient
from chatterbot.filters import RepetitiveResponseFilter
from chatterbot.trainers import ListTrainer
import os

#import logging
#logging.basicConfig(level=logging.INFO)

# Cria uma nova instância do chatBot
bot = ChatBot('Terminal',
    storage_adapter='chatterbot.storage.MongoDatabaseAdapter',
    logic_adapters=[
        'chatterbot.logic.BestMatch'
    ],
    filters=[
        'chatterbot.filters.RepetitiveResponseFilter'
    ],
    input_adapter='chatterbot.input.TerminalAdapter',
    output_adapter='chatterbot.output.TerminalAdapter',
    database='chatterbot'
)

#bot.set_trainer(ListTrainer)

#trainer = ListTrainer(bot)

for arqs in os.listdir('arq'):
    conversa = open('arq/' + arqs, 'r').readlines()
    bot.set_trainer(ListTrainer)
    bot.train(conversa)

print('Olá humano...')

while True:
    try:
        bot_input = bot.get_response(None)
    # Press ctrl-c or ctrl-d on the keyboard to exit
    except (KeyboardInterrupt, EOFError, SystemExit):
        break
