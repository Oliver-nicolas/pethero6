


    public function NewChat($keeperId)
    {
        try {
            $keeper = $this->keeperDAO->SearchByUserId($this->userLogged->getId());
            $keeper = $this->keeperDAO->Search($keeperId);
            $chat = $this->chatDAO->SearchByKeeperKeeper($keeper->getId(), $keeper->getId());

            if ($chat == null) {
                $chat = new Chat();
                $chat->setCreateDate(date('Y-m-d H:i:s'));
                $chat->setKeeper($keeper);
                $chat->setKeeper($keeper);

                if ($this->chatDAO->Add($chat)) {
                    $_SESSION['success'] = 'Chat created';
                }
            } else {
                $_SESSION['error'] = 'You already have a chat with the keeper';
            }
        } catch (\Throwable $th) {
            $_SESSION['error'] = 'Exception. ' . $th->getMessage();
        }
        $this->ShowMyChats();
    }

    public function SendMessage($chatId, $text)
    {
        try {
            $message = new Message();
            $message->setText($text);
            $message->setDate(date('Y-m-d H:i:s'));
            $message->setAutor('Keeper');
            $message->setChat($this->chatDAO->Search($chatId));

            if ($this->messageDAO->Add($message)) {
                $_SESSION['success'] = 'Message sended';
            }
        } catch (\Throwable $th) {
            $_SESSION['error'] = 'Exception. ' . $th->getMessage();
        }
        $this->ShowMyChats($chatId);
    }