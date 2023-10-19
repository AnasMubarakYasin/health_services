error=$(composer i 2>&1 1>/dev/null)
if [ $? -eq 0 ]; then
   echo "Success"
else
   echo "Error: $error"
fi
