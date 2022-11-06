from selenium import webdriver
from selenium.webdriver import FirefoxOptions
from selenium.webdriver.common.by import By
from selenium.webdriver.firefox.options import Options
import urllib


from datetime import datetime
import time

options = Options()
options.headless = False	##Turn false to off headless mode
EmailLogTOcmd = True



url=''



FileWithEmails='emails.txt'		#file with multiple emails to reg
InputEmail='anything.ktago@gqwe.com'	#regular exp randomize e.g.
InputPass='anything'	#randomize e.g.
InputCaptcha='anything'	#captcha solver bot e.g.

with open(FileWithEmails) as file:
        emails = file.readlines()



driver = webdriver.Firefox(options=options)

number=1;
for FileEmail in emails:

	start_time = datetime.now()

	driver.get(url)
	driver.execute_script("document.getElementsByClassName('custom-checkbox')[0].click()")


	email=driver.find_element(By.XPATH, '/html/body/div/div/div/div[2]/div/div[2]/form/div[1]/input')
	password=driver.find_element(By.XPATH, '/html/body/div/div/div/div[2]/div/div[2]/form/div[2]/input')
	confirm_password=driver.find_element(By.XPATH, '/html/body/div/div/div/div[2]/div/div[2]/form/div[3]/input')
	captcha=driver.find_element(By.XPATH, '/html/body/div/div/div/div[2]/div/div[2]/form/div[4]/input')

	email.send_keys(FileEmail)
	password.send_keys(InputPass)
	confirm_password.send_keys(InputPass)
	captcha.send_keys(InputCaptcha)


	#captchaIMG=driver.find_element(By.XPATH, '//*[@id="register-form"]/div[4]/div/img')
	#src = captchaIMG.get_attribute('src')
	#urllib.urlretrieve(src, "captcha.png")

	#path='captchas/captcha'+str(number)+'.png'
	#with open(path, 'wb') as file:
		#file.write(driver.find_element_by_xpath('').screenshot_as_png)

	#number+=1;

	input()
	##Uncomment following to press submit button
	driver.execute_script("document.getElementsByClassName('btn')[0].click()")


	if EmailLogTOcmd:
		print ('email '+FileEmail+' OK')
		print(datetime.now() - start_time)
print('everything OK')
