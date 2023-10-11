#! /bin/bash


#---
# Add git files

git add -A


#---
# Commit the changes

echo "What is the commit name?"

read commit_name

git commit -m "$commit_name"


#---
# Push the commit to github

git push -u origin main

