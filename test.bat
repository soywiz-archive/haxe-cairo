@echo off
pushd example
haxe -main Test -lib cairo -neko n.n && neko n
popd
