import telebot, jsonpickle, subprocess ,os
from database import *

API_KEY = '6026368221:AAEanGlLuHVxeUPn193MLTJdIZxl6ju05xo'

bot = telebot.TeleBot(API_KEY)

# @bot.message_handler(content_types=['text', 'audio', 'document', 'photo', 'sticker', 'video', 'video_note', 'voice', 'location', 'contact'])
#@bot.message_handler(func=lambda message: True)
@bot.message_handler(content_types=["text", "sticker", "pinned_message", "photo", "contact"])
def main (message):
	try :
		Updates = {}
		Updates['message'] = message.json
		encode = jsonpickle.encode(Updates)
		formats = format(encode);
		#print(encode);
		command = subprocess.Popen(['php', 'center.php', format(encode)] ,shell=False)
		#command     = run_script(f"php center.php {formats}");
	except Exception as Errors:
		print('Error !!!',Errors);

@bot.callback_query_handler(func=lambda call: True)
def test_callback(call): # <- passes a CallbackQuery type object to your function
	#logger.info(call)
	#try :
		#if len(re.findall("^buy.|(.+)$",call.data)) > 0:
			#CNN      = re.findall("^buy.|(.+)$",call.data)[0];
			#Headers = {}
			#Headers['callback_query'] = call.json
			#encode = jsonpickle.encode(Headers);
			#command = subprocess.Popen(['python3', 'getHeaders.py', 'check', CNN, format(encode)])
	#except :
		#tty = 0
	try :
		Updates = {}
		Updates['callback_query'] = call.json
		encode = jsonpickle.encode(Updates)
		#print(encode);
		command = subprocess.Popen(['php', 'center.php', format(encode)])
	except Exception as Errors:
		print('Error !!!',Errors);
 
bot.polling()

# >> @F_F_4