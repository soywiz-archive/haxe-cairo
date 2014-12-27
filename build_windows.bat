@echo off
pushd project
REM rd /q /s obj
haxelib run hxcpp Build.xml -Dwindows
popd
