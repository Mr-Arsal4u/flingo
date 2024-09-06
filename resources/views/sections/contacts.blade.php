<section id="contacts-list" class="discussions">
    <div class="discussion search">
        <div class="searchbar">
            <i class="fa fa-search" aria-hidden="true"></i>
            <input type="text" placeholder="Search..."></input>
        </div>
    </div>
    @forelse ($contacts as $contact)
        @include('contacts.list')
    @empty
        <p>Please add contacts</p>
    @endforelse
</section>