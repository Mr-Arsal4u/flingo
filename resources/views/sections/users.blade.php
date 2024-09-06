<section id="users-list" class="discussions" style="display: none">
    <div class="discussion search">
        <div class="searchbar">
            <i class="fa fa-search" aria-hidden="true"></i>
            <input type="text" placeholder="Search..."></input>
        </div>
    </div>
    @forelse ($allUsers as $user)
        @include('contacts.users')
    @empty
        <p>Please add contacts</p>
    @endforelse
</section>