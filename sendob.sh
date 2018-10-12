 IFS=$'\n'
# переменные полученные из php-скрипта по порядку.
POS2="$1"
# основная команда
curl -s -X POST https://api.telegram.org/bot<?BOT_TOKEN?>/sendMessage -d chat_id=<?CHAT_ID?> -d text="$POS2"

