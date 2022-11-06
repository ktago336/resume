ProfiCaptcha 0.5
(c) Leontyev Valera (Profigroup Company), 2007—2008

=== Contents === 

1. About script. 
2. Licence. 
3. Installation and use. 
4. Links 

=== About script ===

CAPTCHA is an abbreviation of the English words "Completely Automatic Public Turing Test to Tell 
Computers and Humans Apart" - fully automatic Ai to differentiate computers and people. In other
words, it is a task that is easily solve people, but who can not (or it is extremely difficult)
to teach the computer to solve.
CAPTCHA used to prevent multiple automated registration and send robots. CAPTCHA used for spam
protection, flood protection and seizure of accounts.
Most CAPTCHA looks like one way or another noisy random number, word or another symbols, the user
needs to be read and enter a result, although there are other algorithms.
ProfiCaptcha is PHP script for a site inspection at the visitor "human face" to protect against
spam and robots. The format is inserted image generated script, which shows the symbols. Picture
immune recognition robots. User reading figures in the picture and puts them in the field of the
form. Script of form processing checks for a user code in the special session variable. If the code
is not found, returned error code and the proposal again.

Developers: Valery Leontyev (feedbee@gmail.com)
The 0.1 version was developed by Alexander Sukach. But it was rewiten at 90%.
Requirements: PHP5 with the GD and FreeType libraries and included support for standard sessions.

=== Licence : BSD === 

Copyright (c) 2007—2008, Leontyev Valera (Profigroup Company)
All rights reserved. 

Redistribution and use in source and binary forms, with or without modification, are permitted 
provided that the following conditions are met: 
- Redistributions of source code must retain the above copyright notice, this list of conditions 
and the following disclaimer. 
- Redistributions in binary form must reproduce the above copyright notice, this list of 
conditions and the following disclaimer in the documentation and / or other materials provided 
with the distribution. 
- Neither the name of Leontyev Valera or the Profigroup Company nor the names of its contributors
may be used to endorse or promote products derived from this software without specific prior
written permission. 

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS 
"AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT 
LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR 
A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR 
CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, 
EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, 
PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR 
PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF 
LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING 
NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS 
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE. 

=== Installation and use ===

You need to do the following steps to integrate script in your site: 
1) Unpack archive of the script. 
2) Open file Settings.php in text or PHP editor. Make the changes you need in the file.
3) Load all the files on your server (recommended in a separate folder).
4) Insert images and field to enter the code into your HTML form on the site (see example).
5) In serving form script insert lines to test entered code. The code should present in the array
$_SESSION[SESSION_KEY] where SESSION_KEY is a class constant (set in script setup (by default:
"VeryficationNumber", i.e. array $_SESSION['VeryficationNumber'])). 

The script can be customized. To do this, change options in file Settings.php (all settings
commented), and experiment with the results. In addition, you can change the background image and
font files. The size of the resulting the image is the size of background picture. Script randomly
selects an image-file and font-file (for each symbol) from the directory specified in the settings.
Background images must be in PNG, JPEG or GIF formats.

=== Links ===

- Page of ProfiCaptcha script - http://valera.ws/proficaptcha/ 
- The site of "Profigrup Company" - http://profigroup.by/ 
- Author's blog - http://valera.ws/ 
- The Russian-language resource on CAPTCHA - http://captcha.ru/
- Wiki-page about CAPTCHA - http://en.wikipedia.org/wiki/Captcha

Good luck!