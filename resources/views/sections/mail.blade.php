<section id="mail-section" class="discussions" style="display: none">
    <div class="discussion search">
        <div class="searchbar">
            <i class="fa fa-search" aria-hidden="true"></i>
            <input type="text" placeholder="Search...">
        </div>
    </div>
    <form id="mail-form" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="contact-form">
            <div class="form-group">
                <label for="mail">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="4" placeholder="Enter your message" required></textarea>
            </div>
            <button type="submit">Send</button>
        </div>
    </form>
</section>
