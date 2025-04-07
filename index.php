<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Widget</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="chat-widget">
        <!-- Chat Toggle Button -->
        <div class="chat-toggle" id="chat-toggle">
            <i class="fas fa-comments"></i>
            <span class="chat-tooltip">Bize Sorun</span>
        </div>

        <!-- Chat Window -->
        <div class="chat-window" style="display: none;">
            <div class="chat-header">
                <div class="title">
                    <i class="fas fa-robot"></i>
                    Destek Robotu
                </div>
                <div class="chat-controls">
                    <button class="minimize-btn" id="minimize-btn">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="chat-body">
                <div class="messages form">
                    <div class="bot-inbox inbox">
                        <div class="icon">
                            <i class="fas fa-robot"></i>
                        </div>
                        <div class="msg-header">
                            <p>Merhaba size nasıl yardımcı olabilirim?</p>
                        </div>
                    </div>
                </div>
                <div class="typing-field">
                    <div class="input-data">
                        <textarea id="data" type="text" placeholder="Sorunuzu yazın.." required></textarea>
                        <button id="send-btn">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function(){
        // Chat widget toggle
        $("#chat-toggle, #minimize-btn").on("click", function(){
            $(".chat-window").slideToggle(300);
            $(".chat-tooltip").toggleClass("hidden");
        });

        // Mesaj gönderme
        $("#send-btn").on("click", function(){
            $value = $("#data").val();
            if($value.trim() === "") return;

            $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $value +'</p></div></div>';
            $(".messages").append($msg);
            $("#data").val('');
            
            // AJAX ile mesaj gönderme
            $.ajax({
                url: 'mesaj.php',
                type: 'POST',
                data: {
                    mesaj: $value
                },
                success: function(response){
                    var data = JSON.parse(response);
                    $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-robot"></i></div><div class="msg-header"><p>'+ data.cevap +'</p></div></div>';
                    $(".messages").append($replay);
                    $(".messages").scrollTop($(".messages")[0].scrollHeight);
                }
            });
        });

        // Enter tuşu ile gönderme
        $("#data").on("keypress", function(e){
            if(e.which == 13 && !e.shiftKey){
                e.preventDefault();
                $("#send-btn").click();
            }
        });
    });
    </script>
</body>
</html>