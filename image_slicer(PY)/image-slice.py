from PIL import Image
from pathlib import Path
import os
import time

t1=time.time()
Files = []

path1=''
os.chdir(path1)


for filename in os.listdir('.'):
    if filename.endswith('.png'):
        Files.append(filename)

for filename in Files:
    img = Image.open(filename)
    area1=(27,0,51,37)
    img1 = img.crop(area1)
    area2=(51,0,70,37) 
    img2 = img.crop(area2)
    area3=(68,0,86,37) 
    img3 = img.crop(area3)
    area4=(86,0,102,37) 
    img4 = img.crop(area4)
    area5=(102,0,123,37) 
    img5 = img.crop(area5)    
    img1.save("/py/python_bot/captcha/o/"+filename+"1"+".png")
    img2.save("/py/python_bot/captcha/o/"+filename+"2"+".png")
    img3.save("/py/python_bot/captcha/o/"+filename+"3"+".png")
    img4.save("/py/python_bot/captcha/o/"+filename+"4"+".png")
    img5.save("/py/python_bot/captcha/o/"+filename+"5"+".png")
t2=time.time()
print(t2-t1)
