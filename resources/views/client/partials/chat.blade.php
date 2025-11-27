<div class="card-body">
    <div class="chat-messages-container perfect-scrollbar mb-3"> {{-- Adjusted max-height via CSS --}}
        <div class="chat-message received"> <div class="message-content"> Hi, just wanted to check on the status... </div> <div class="message-meta">Client Name - 10/26/2023 09:30 AM</div> </div>
        <div class="chat-message sent"> <div class="message-content"> Hi [Client Name], we're currently reviewing... </div> <div class="message-meta">Your Name - 10/26/2023 09:35 AM</div> </div>
        <div class="chat-message received"> <div class="message-content"> Okay, thank you! </div> <div class="message-meta">Client Name - 10/26/2023 09:36 AM</div> </div>
        @for ($i = 0; $i < 5; $i++) <div class="chat-message {{ $i % 2 == 0 ? 'sent' : 'received' }}"> <div class="message-content"> This is another message, number {{ $i + 4 }}. {{ $i % 2 == 0 ? 'Sent by us.' : 'Received from client.' }} </div> <div class="message-meta">{{ $i % 2 == 0 ? 'Your Name' : 'Client Name' }} - 10/2{{ 7+$i }}/2023 10:{{ $i }}5 AM</div> </div> @endfor
    </div>
    <div class="chat-input-group input-group input-group-sm">
        <input type="text" class="form-control fs-xs" placeholder="Type your message...">
        <button class="btn btn-primary" type="button" title="Send Message"> <i class="ri-send-plane-2-line ri-small"></i> </button>
    </div>
</div>