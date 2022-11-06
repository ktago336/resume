from PIL import Image
from pathlib import Path
import os
import time
import psutil
import shutil
import pyautogui

t1=time.time()
Files = []

#working path
path1=''
os.chdir(path1)

#Get all images paths
for filename in os.listdir(path1):
    if filename.endswith('.png'):
        Files.append(filename)
NofFiles=len(Files)
print('всего файлов '+ str(NofFiles))
for filename in Files:

    #show image
    img = Image.open(filename)
    img.show()
    img.close()

    #switch to console (костыль)
    pyautogui.keyDown('alt')
    pyautogui.press('tab')
    pyautogui.keyUp('alt')
    pyautogui.keyUp('tab')

    #waiting input
    destination=input()
    
    #close window with pic
    PROCNAME='display'
    for proc in psutil.process_iter():
        if proc.name() == PROCNAME:
            proc.kill()
    
    #if inputed->sort file, else->delete
    if (destination):
        shutil.copy(filename, destination)
    else:
        os.remove(filename)
    NofFiles-=1;
    print('осталось '+str(NofFiles))


t2=time.time()
print(t2-t1)
