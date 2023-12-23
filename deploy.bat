@echo off
chcp 65001

set /p SqlPath="请输入MySQL的bin目录路径（例如：C:\Program Files\MySQL\MySQL Server 8.0\bin\）: "
set /p SqlName="请输入MySQL具体可执行文件（例如：mysql.exe）: "
cd data
set /p User="请输入用户名（例如：root）: "
set /p Password="请输入密码: "
"%SqlPath%%SqlName%" -h localhost -u %User% -p%Password% < "create.sql"

cd ..
call init.bat
set oldName=root
set newName=%User%
set oldPassword=''
set newPassword='%Password%'

set fileName=common\config\main-local.php
set count=0

(for /f "delims=" %%a in ('findstr /n .* %~dp0%fileName%') do (
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
move /y "tmp.php" "%fileName%"
pause
cd data
"%SqlPath%%SqlName%" -h localhost -u %User% -p%Password% -D yii2advanced < "install.sql"
cd ..
python news.py
yii.bat migrate