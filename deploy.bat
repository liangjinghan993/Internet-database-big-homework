@echo off
cd %1
httpd.exe -k start
cd %2
net start mysql
cd /d %~dp0
cd Yii-main/data
set SqlPath = %2
%SqlPath%mysql.exe -h localhost -u%3 -p%4 < create.sql
cd ..
call init.bat
cd common/config
set oldName=root
set newName=%3
set aa='
set bb=%4
set oldPassword=''
set newPassword=%aa%%bb%%aa%
set fileName=main-local.php
set count=0
(for /f "delims=" %%a in ('findstr /n .* %fileName%') do (
	set /a count+=1
	set num=10
	set "str=%%a"
	
	setlocal enabledelayedexpansion
	set str=!str:%oldName%=%newName%!
    set str=!str:%oldPassword%=%newPassword%!

	if !count! lss !num! (
		echo,!str:~2!
	) else (
		echo,!str:~3!
	)
	
	endlocal
))>tmp.php
move /y "tmp.php" "main-local.php"
cd ../..
pause
yii.bat migrate
cd data
%SqlPath%mysql.exe -h localhost -u%3 -p%4 < data_mysql5.7.sql