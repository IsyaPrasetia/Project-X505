<footer>
  <div class="footer-grid">
    <div class="footer-brand">
      <div class="nav-logo" style="display:block;margin-bottom:16px;">
        Perusahaan<span style="color:var(--gold)"> Testing</span> Project
      </div>
      <p>Platform edukasi dan informasi kesehatan terpercaya.</p>
    </div>
    <div class="footer-col">
      <h4>Webinar</h4>
      <ul>
        <li><a href="{{ url('/webinars') }}">Jadwal Webinar</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Perusahaan</h4>
      <ul>
        <li><a href="{{ url('/contact') }}">Tentang Kami</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Dukungan</h4>
      <ul>
        <li><a href="{{ isset($contacts['whatsapp']) && $contacts['whatsapp'] ? $contacts['whatsapp'] : '#' }}" target="_blank" rel="noopener">Pusat Dukungan</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    &copy; 2026 Perusahaan Testing Project. Seluruh hak cipta dilindungi. Terdaftar di Indonesia 🇮🇩
  </div>
</footer>
