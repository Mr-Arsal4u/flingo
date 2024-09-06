<section class="chat" id="chat-section" style="display: none">
                <div class="header-chat">
                    <i class="icon fa fa-user-o" aria-hidden="true"></i>
                    <p id="display-name" class="name"></p>
                    <i class="icon clickable fa fa-ellipsis-h right" aria-hidden="true"></i>
                </div>
                @include('chat.messages')
                <div class="footer-chat">
                    <form id="chat-form">
                        <i class="icon fa fa-smile-o clickable" style="font-size:25pt;" aria-hidden="true"></i>
                        <input type="text" class="write-message" name="message"
                            placeholder="Type your message here" required></input>
                        <button type="submit" class="icon send fa fa-paper-plane-o clickable"
                            aria-hidden="true"></button>
                    </form> 
                </div>
            </section>