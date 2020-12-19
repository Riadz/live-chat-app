#!/bin/bash
ionic cap build android --no-open
cd android
./gradlew assembleDebug
./gradlew installDebug
cd ..
ionic cap run android --no-open -l --external --port=8100