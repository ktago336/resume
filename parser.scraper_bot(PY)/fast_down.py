import requests

url=''	#direct url to image generator

for x in range(500):
	
	response = requests.get(url)

	file = open("captcha/"+str(x)+'.png', "wb")
	file.write(response.content)
	file.close()