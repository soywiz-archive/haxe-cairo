@echo off
pushd project
rd /q /s obj
haxelib run hxcpp Build.xml -Dwindows
popd
