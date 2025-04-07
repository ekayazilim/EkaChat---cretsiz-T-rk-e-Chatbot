(function() {
    // Chatbot URL'si - Kendi sunucu adresinize göre değiştirin
    const CHATBOT_URL = 'https://ekasunucu.org/chatbot';

    // Stil dosyasını ekle
    const style = document.createElement('style');
    style.textContent = `
        .chat-widget {
            position: fixed !important;
            bottom: 20px !important;
            right: 20px !important;
            z-index: 999999 !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .chat-toggle {
            width: 60px !important;
            height: 60px !important;
            background: #2196F3 !important;
            border-radius: 50% !important;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important;
            cursor: pointer !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            transition: all 0.3s ease !important;
            position: relative !important;
        }
        .chat-toggle i {
            color: white !important;
            font-size: 24px !important;
        }
        .chat-toggle:hover {
            transform: scale(1.1) !important;
        }
        .chat-tooltip {
            position: absolute !important;
            right: 70px !important;
            background: #333 !important;
            color: white !important;
            padding: 8px 12px !important;
            border-radius: 4px !important;
            font-size: 14px !important;
            white-space: nowrap !important;
            opacity: 0 !important;
            transition: opacity 0.3s ease !important;
        }
        .chat-toggle:hover .chat-tooltip {
            opacity: 1 !important;
        }
        .chat-window {
            position: fixed !important;
            bottom: 90px !important;
            right: 20px !important;
            width: 350px !important;
            height: 500px !important;
            background: white !important;
            border-radius: 10px !important;
            box-shadow: 0 5px 15px rgba(0,0,0,0.15) !important;
            display: none;
            flex-direction: column !important;
            overflow: hidden !important;
            z-index: 999998 !important;
        }
        .chat-header {
            background: #2196F3 !important;
            color: white !important;
            padding: 15px !important;
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
        }
        .chat-header .title {
            display: flex !important;
            align-items: center !important;
            gap: 10px !important;
            font-weight: 500 !important;
        }
        .chat-body {
            flex: 1 !important;
            display: flex !important;
            flex-direction: column !important;
        }
        .messages {
            flex: 1 !important;
            overflow-y: auto !important;
            padding: 15px !important;
        }
        .typing-field {
            padding: 15px !important;
            border-top: 1px solid #eee !important;
        }
        .input-data {
            position: relative !important;
            display: flex !important;
            gap: 10px !important;
        }
        .input-data textarea {
            width: 100% !important;
            border: 1px solid #ddd !important;
            padding: 10px !important;
            border-radius: 6px !important;
            height: 40px !important;
            resize: none !important;
            font-size: 14px !important;
            font-family: inherit !important;
        }
        .input-data button {
            background: #2196F3 !important;
            color: white !important;
            border: none !important;
            padding: 0 15px !important;
            border-radius: 6px !important;
            cursor: pointer !important;
            transition: background 0.3s ease !important;
        }
        .input-data button:hover {
            background: #1976D2 !important;
        }
        .bot-inbox, .user-inbox {
            display: flex !important;
            align-items: flex-start !important;
            margin: 10px 0 !important;
        }
        .bot-inbox .icon {
            width: 35px !important;
            height: 35px !important;
            background: #2196F3 !important;
            border-radius: 50% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin-right: 10px !important;
        }
        .bot-inbox .icon i {
            color: white !important;
            font-size: 16px !important;
        }
        .msg-header {
            max-width: 70% !important;
            padding: 10px 15px !important;
            border-radius: 10px !important;
        }
        .bot-inbox .msg-header {
            background: #2196F3 !important;
            color: white !important;
        }
        .user-inbox .msg-header {
            background: #e3f2fd !important;
            color: #333 !important;
            margin-left: auto !important;
        }
        .msg-header p {
            margin: 0 !important;
            font-size: 14px !important;
            line-height: 1.4 !important;
        }
        /* Scrollbar stilleri */
        .messages::-webkit-scrollbar {
            width: 6px !important;
        }
        .messages::-webkit-scrollbar-track {
            background: #f1f1f1 !important;
        }
        .messages::-webkit-scrollbar-thumb {
            background: #ccc !important;
            border-radius: 3px !important;
        }
        /* Mobil uyumluluk */
        @media (max-width: 480px) {
            .chat-window {
                width: calc(100% - 40px) !important;
                height: calc(100% - 120px) !important;
            }
        }
    `;
    document.head.appendChild(style);

    // Font Awesome ekle
    const fontAwesome = document.createElement('link');
    fontAwesome.rel = 'stylesheet';
    fontAwesome.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css';
    document.head.appendChild(fontAwesome);

    // jQuery ekle (eğer sayfada yoksa)
    if (typeof jQuery === 'undefined') {
        const script = document.createElement('script');
        script.src = 'https://code.jquery.com/jquery-3.5.1.min.js';
        script.onload = initChatbot;
        document.head.appendChild(script);
    } else {
        initChatbot();
    }

    function initChatbot() {
        // Chatbot HTML'ini oluştur
        const chatbotHTML = `
            <div class="chat-widget">
                <div class="chat-toggle" id="chat-toggle">
                    <i class="fas fa-comments"></i>
                    <span class="chat-tooltip">Bize Sorun</span>
                </div>
                <div class="chat-window">
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
        `;

        // Chatbot'u sayfaya ekle
        document.body.insertAdjacentHTML('beforeend', chatbotHTML);

        // Event listener'ları ekle
        $(document).ready(function() {
            $("#chat-toggle, #minimize-btn").on("click", function() {
                $(".chat-window").slideToggle(300);
                $(".chat-tooltip").toggleClass("hidden");
            });

            $("#send-btn").on("click", function() {
                $value = $("#data").val();
                if($value.trim() === "") return;

                $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $value +'</p></div></div>';
                $(".messages").append($msg);
                $("#data").val('');
                
                // AJAX ile mesaj gönderme
                $.ajax({
                    url: CHATBOT_URL + '/mesaj.php',
                    type: 'POST',
                    data: {
                        mesaj: $value
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-robot"></i></div><div class="msg-header"><p>'+ data.cevap +'</p></div></div>';
                        $(".messages").append($replay);
                        $(".messages").scrollTop($(".messages")[0].scrollHeight);
                    }
                });
            });

            $("#data").on("keypress", function(e) {
                if(e.which == 13 && !e.shiftKey) {
                    e.preventDefault();
                    $("#send-btn").click();
                }
            });
        });
    }
})(); 