<div class="flex flex-col w-full h-auto p-4 bg-white rounded">
  <h2 class="text-lg text-black font-bold mb-2">Purge Cache</h2>
  <div class="w-full h-auto mb-4">
    <p class="text-base text-black ">Den Inhaltsspeicher von Vercel leeren. Dieser funktioniert ähnlich wie eine Datenbank. Er wird automatisch aus den Abfragen zwischen Frontend und CMS erstellt.</p>
  </div>
  <div class="w-full h-auto flex justify-end">
    <form action="{{ cp_route('vercel-statamic.purge',) }}" method="post">
      @csrf
      <button type="submit" class="btn btn-primary">Purge all</a>

    </form>
  </div>
</div>