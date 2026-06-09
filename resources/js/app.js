import Alpine from 'alpinejs'

Alpine.store('app', {
  stats: {
    participants: '50.000+',
    webinars: '120+',
    experts: '200+',
  },

  faqs: [
    {
      q: 'Apakah sertifikat dari HealthTalk diakui secara resmi?',
      a: 'Ya, sertifikat HealthTalk diakui secara nasional dan telah terakreditasi oleh IDI (Ikatan Dokter Indonesia) untuk SKP. Sertifikat dikirim dalam format digital yang dapat diverifikasi.',
      open: false,
    },
    {
      q: 'Bagaimana cara mengakses rekaman webinar?',
      a: 'Peserta paket Profesional dan Institusi dapat mengakses rekaman webinar melalui dashboard pribadi hingga 30 hari setelah webinar berlangsung.',
      open: false,
    },
    {
      q: 'Apakah bisa mendaftar sebagai masyarakat umum (bukan tenaga kesehatan)?',
      a: 'Tentu saja! Banyak webinar kami dirancang untuk masyarakat umum yang ingin meningkatkan literasi kesehatan. Beberapa webinar memang khusus untuk tenaga medis, namun akan selalu tertera di deskripsi.',
      open: false,
    },
    {
      q: 'Platform apa yang digunakan untuk webinar?',
      a: 'Kami menggunakan Zoom Webinar sebagai platform utama. Link dan panduan bergabung akan dikirimkan melalui email setelah pendaftaran berhasil dikonfirmasi.',
      open: false,
    },
    {
      q: 'Bagaimana kebijakan pengembalian dana (refund)?',
      a: 'Kami menerima permintaan refund hingga 48 jam sebelum webinar dimulai. Pengembalian dana akan diproses dalam 3–5 hari kerja. Hubungi tim support kami untuk informasi lebih lanjut.',
      open: false,
    },
  ],

  toggleFaq(id) {
    this.faqs[id].open = !this.faqs[id].open
  },
})

Alpine.start()

function scrollReveal() {
  var reveals = document.querySelectorAll('.reveal')
  for (var i = 0; i < reveals.length; i++) {
    var windowHeight = window.innerHeight
    var elementTop = reveals[i].getBoundingClientRect().top
    var elementVisible = 200
    if (elementTop < windowHeight - elementVisible) {
      reveals[i].classList.add('active')
    }
  }
}
window.addEventListener('scroll', scrollReveal)
scrollReveal()
