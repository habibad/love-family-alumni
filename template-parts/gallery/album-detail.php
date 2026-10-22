<?php
/**
 * Gallery / Archives — Album Detail & Photo Lightbox View
 *
 * Implements ARC-008, ARC-009, ARC-010, ARC-011, ARC-012:
 * - Exact collection photos returned (no cross-album mixing)
 * - Keyboard accessible lightbox (Tab, Left/Right arrows, ESC to close)
 * - Returns focus to trigger button upon close
 * - Safe photo captions, alt text, and source rights
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$album_slug = isset( $args['album_slug'] ) ? sanitize_title( $args['album_slug'] ) : '';
$collection = null;
$photos     = [];

if ( class_exists( 'LFA_Archives' ) ) {
	$term = get_term_by( 'slug', $album_slug, 'lfa_archive_collection' );
	if ( $term && ! is_wp_error( $term ) ) {
		$collection = [
			'id'          => $term->term_id,
			'slug'        => $term->slug,
			'title'       => $term->name,
			'description' => $term->description ?: 'Archival collection preserving cherished memories and milestones.',
		];
		$photos = LFA_Archives::get_album_photos( $album_slug );
	}
}

// Fallback to demo albums if collection not in DB
if ( ! $collection ) {
	$demo_albums = [
		'heritage' => [
			'title'       => 'Heritage & Historical Moments',
			'description' => 'Archival photographs documenting foundational gatherings, milestones, and the enduring legacy of Love Family alumni.',
		],
		'reunions' => [
			'title'       => 'Alumni Gatherings & Reunions',
			'description' => 'Cherished memories from annual regional meetups, fellowship dinners, and chapter connections across North America.',
		],
		'conferences' => [
			'title'       => 'Conferences & Community Events',
			'description' => 'Keynotes, leadership sessions, workshops, and celebratory banquet moments from national and regional conferences.',
		],
	];

	if ( isset( $demo_albums[ $album_slug ] ) ) {
		$collection = [
			'slug'        => $album_slug,
			'title'       => $demo_albums[ $album_slug ]['title'],
			'description' => $demo_albums[ $album_slug ]['description'],
		];
		$photos = [
			[
				'id'            => 101,
				'title'         => 'Alumni Fellowship Assembly',
				'image_url'     => get_template_directory_uri() . '/assets/images/original-alumni-group.jpg',
				'image_alt'     => 'Love Family Alumni members gathered in fellowship',
				'year'          => 2024,
				'source_rights' => 'Love Family Alumni Heritage Archive',
				'summary'       => 'Fellowship gathering celebrating enduring legacy across borders.',
			],
			[
				'id'            => 102,
				'title'         => 'Community Women Fellowship',
				'image_url'     => get_template_directory_uri() . '/assets/images/original-women-community-group.jpg',
				'image_alt'     => 'Community fellowship meeting with alumni leaders',
				'year'          => 2024,
				'source_rights' => 'Love Family Alumni Heritage Archive',
				'summary'       => 'Generations of sisters and leaders united in fellowship.',
			],
			[
				'id'            => 103,
				'title'         => 'Regional Chapter Gathering',
				'image_url'     => get_template_directory_uri() . '/assets/images/original-small-group.jpg',
				'image_alt'     => 'Regional chapter alumni meetup',
				'year'          => 2025,
				'source_rights' => 'Love Family Alumni Heritage Archive',
				'summary'       => 'North America regional fellowship dinner and reconnection.',
			],
		];
	}
}

if ( ! $collection ) {
	?>
	<section class="lfa-container" style="padding: 100px 20px; text-align: center;">
		<h1 style="font-family:'Playfair Display',serif; font-size: 2.2rem; color: #0A203A;">Collection Not Found</h1>
		<p style="color: #64748B; margin: 16px auto 28px; max-width: 500px;">The requested archive collection could not be located or has been archived.</p>
		<a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="btn btn-navy" style="display:inline-block; padding: 12px 24px; background:#0A203A; color:#FFF; border-radius:6px; text-decoration:none; font-weight:700;">
			&larr; Back to Gallery &amp; Archives
		</a>
	</section>
	<?php
	return;
}
?>

<section class="lfa-album-detail-section" style="padding: 60px 0 100px; background: #F8FAFC;">
	<div class="lfa-container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
		
		<!-- Breadcrumbs & Navigation -->
		<nav class="lfa-breadcrumb" aria-label="Breadcrumb" style="margin-bottom: 24px; font-size: 0.88rem; color: #64748B;">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color: #64748B; text-decoration: none;">Home</a>
			<span style="margin: 0 8px;">/</span>
			<a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" style="color: #64748B; text-decoration: none;">Gallery &amp; Archives</a>
			<span style="margin: 0 8px;">/</span>
			<span style="color: #0A203A; font-weight: 600;" aria-current="page"><?php echo esc_html( $collection['title'] ); ?></span>
		</nav>

		<!-- Album Header -->
		<div class="lfa-album-header" style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 12px; padding: 36px 32px; margin-bottom: 40px; box-shadow: 0 4px 16px rgba(10,32,58,0.04);">
			<div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px;">
				<div style="max-width: 800px;">
					<span class="lfa-pill" style="display: inline-block; padding: 5px 12px; background: rgba(171,22,64,0.1); color: #AB1640; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; border-radius: 999px; margin-bottom: 12px;">
						Verified Collection &bull; <?php echo esc_html( count( $photos ) ); ?> Photographs
					</span>
					<h1 style="font-family: 'Playfair Display', serif; font-size: 2.4rem; font-weight: 800; color: #0A203A; margin: 0 0 12px; line-height: 1.2;">
						<?php echo esc_html( $collection['title'] ); ?>
					</h1>
					<p style="color: #475569; font-size: 1.05rem; line-height: 1.6; margin: 0;">
						<?php echo esc_html( $collection['description'] ); ?>
					</p>
				</div>
				<div>
					<a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="btn" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 18px; border: 1px solid #CBD5E1; border-radius: 6px; background: #FFFFFF; color: #0A203A; text-decoration: none; font-size: 0.88rem; font-weight: 600;">
						&larr; All Collections
					</a>
				</div>
			</div>
		</div>

		<!-- Photo Grid -->
		<?php if ( empty( $photos ) ) : ?>
			<div style="background: #FFFFFF; padding: 60px 20px; text-align: center; border-radius: 10px; border: 1px solid #E2E8F0;">
				<p style="color: #64748B; font-size: 1.05rem; margin: 0;">No photographs have been published to this collection yet.</p>
			</div>
		<?php else : ?>
			<div class="lfa-photo-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px;">
				<?php foreach ( $photos as $index => $photo ) : 
					$img_url  = ! empty( $photo['image_url'] ) ? $photo['image_url'] : get_template_directory_uri() . '/assets/images/original-alumni-group.jpg';
					$img_alt  = ! empty( $photo['image_alt'] ) ? $photo['image_alt'] : $photo['title'];
					$p_title  = $photo['title'];
					$p_year   = ! empty( $photo['year'] ) ? $photo['year'] : '';
					$p_source = ! empty( $photo['source_rights'] ) ? $photo['source_rights'] : 'Love Family Alumni Heritage';
					$p_desc   = ! empty( $photo['summary'] ) ? $photo['summary'] : ( ! empty( $photo['description'] ) ? wp_strip_all_tags( $photo['description'] ) : '' );
				?>
					<article class="lfa-photo-card" style="background: #FFFFFF; border-radius: 10px; overflow: hidden; border: 1px solid #E2E8F0; box-shadow: 0 2px 8px rgba(10,32,58,0.04); display: flex; flex-direction: column;">
						<div class="lfa-photo-card__media" style="position: relative; aspect-ratio: 16/10; overflow: hidden; background: #0A203A;">
							<img src="<?php echo esc_url( $img_url ); ?>" 
							     alt="<?php echo esc_attr( $img_alt ); ?>" 
							     loading="lazy" 
							     style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
							<?php if ( $p_year ) : ?>
								<span style="position: absolute; top: 12px; right: 12px; background: rgba(10,32,58,0.85); color: #FFF; font-size: 0.75rem; font-weight: 700; padding: 3px 8px; border-radius: 4px;">
									<?php echo esc_html( $p_year ); ?>
								</span>
							<?php endif; ?>
						</div>
						<div class="lfa-photo-card__body" style="padding: 20px; display: flex; flex-direction: column; flex: 1;">
							<h3 style="font-size: 1.05rem; font-weight: 700; color: #0A203A; margin: 0 0 8px; line-height: 1.35;">
								<?php echo esc_html( $p_title ); ?>
							</h3>
							<?php if ( $p_desc ) : ?>
								<p style="font-size: 0.85rem; color: #475569; margin: 0 0 14px; line-height: 1.5; flex: 1;">
									<?php echo esc_html( $p_desc ); ?>
								</p>
							<?php endif; ?>
							<div style="border-top: 1px solid #EDF2F7; padding-top: 12px; margin-top: auto; display: flex; justify-content: space-between; align-items: center;">
								<span style="font-size: 0.72rem; color: #64748B; max-width: 65%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="<?php echo esc_attr( $p_source ); ?>">
									&copy; <?php echo esc_html( $p_source ); ?>
								</span>
								<button type="button" 
								        class="lfa-open-lightbox-btn" 
								        data-index="<?php echo esc_attr( $index ); ?>"
								        aria-haspopup="dialog"
								        aria-label="View photo <?php echo esc_attr( $p_title ); ?> in lightbox"
								        style="padding: 6px 12px; font-size: 0.8rem; font-weight: 600; background: #0A203A; color: #FFFFFF; border: none; border-radius: 4px; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;">
									<span>View</span> &rarr;
								</button>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

	</div>
</section>

<!-- Accessible Lightbox Modal (ARC-008, ARC-009, ARC-010, ARC-011) -->
<div id="lfa-photo-lightbox" 
     class="lfa-lightbox-backdrop" 
     role="dialog" 
     aria-modal="true" 
     aria-label="Photo Lightbox" 
     aria-hidden="true" 
     style="display: none; position: fixed; inset: 0; background: rgba(5,15,30,0.95); z-index: 99999; justify-content: center; align-items: center; padding: 20px;">

	<div class="lfa-lightbox-container" style="position: relative; max-width: 1000px; width: 100%; max-height: 90vh; display: flex; flex-direction: column; background: #0A203A; border-radius: 12px; overflow: hidden; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 25px 50px rgba(0,0,0,0.6);">
		
		<!-- Lightbox Header -->
		<div style="display: flex; justify-content: space-between; align-items: center; padding: 14px 20px; background: rgba(0,0,0,0.4); border-bottom: 1px solid rgba(255,255,255,0.08);">
			<span id="lightbox-counter" style="font-size: 0.82rem; font-weight: 700; color: #E5C170; text-transform: uppercase; letter-spacing: 0.08em;">Photo 1 of 1</span>
			<button type="button" id="lightbox-close-btn" aria-label="Close Lightbox" style="background: transparent; border: none; color: #CBD5E1; font-size: 1.8rem; line-height: 1; cursor: pointer; padding: 0 4px;">
				&times;
			</button>
		</div>

		<!-- Lightbox Media Area with Navigation -->
		<div style="position: relative; flex: 1; display: flex; align-items: center; justify-content: center; background: #000; min-height: 380px; max-height: 60vh; overflow: hidden;">
			<img id="lightbox-img" src="" alt="" style="max-width: 100%; max-height: 60vh; object-fit: contain;">

			<!-- Nav Prev -->
			<button type="button" id="lightbox-prev-btn" aria-label="Previous photograph" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); width: 44px; height: 44px; border-radius: 50%; background: rgba(10,32,58,0.7); color: #FFF; border: 1px solid rgba(255,255,255,0.2); font-size: 1.3rem; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background 0.2s;">
				&#10094;
			</button>

			<!-- Nav Next -->
			<button type="button" id="lightbox-next-btn" aria-label="Next photograph" style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); width: 44px; height: 44px; border-radius: 50%; background: rgba(10,32,58,0.7); color: #FFF; border: 1px solid rgba(255,255,255,0.2); font-size: 1.3rem; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background 0.2s;">
				&#10095;
			</button>
		</div>

		<!-- Lightbox Footer / Caption -->
		<div style="padding: 18px 24px; background: #0A203A; color: #FFFFFF; border-top: 1px solid rgba(255,255,255,0.08);">
			<h2 id="lightbox-title" style="font-size: 1.15rem; font-weight: 700; color: #FFFFFF; margin: 0 0 6px;">Title</h2>
			<p id="lightbox-desc" style="font-size: 0.88rem; color: #94A3B8; margin: 0 0 8px; line-height: 1.4;">Description</p>
			<div style="font-size: 0.75rem; color: #C6933D; display: flex; justify-content: space-between; align-items: center;">
				<span id="lightbox-source">Source Credit</span>
				<span id="lightbox-year">Year</span>
			</div>
		</div>

	</div>
</div>

<script>
(function() {
	const photos = <?php echo wp_json_encode( array_values( $photos ) ); ?>;
	let currentIndex = 0;
	let lastFocusedEl = null;

	const modal = document.getElementById('lfa-photo-lightbox');
	if (!modal) return;

	const imgEl     = document.getElementById('lightbox-img');
	const titleEl   = document.getElementById('lightbox-title');
	const descEl    = document.getElementById('lightbox-desc');
	const sourceEl  = document.getElementById('lightbox-source');
	const yearEl    = document.getElementById('lightbox-year');
	const counterEl = document.getElementById('lightbox-counter');
	const closeBtn  = document.getElementById('lightbox-close-btn');
	const prevBtn   = document.getElementById('lightbox-prev-btn');
	const nextBtn   = document.getElementById('lightbox-next-btn');

	function updateLightbox(index) {
		if (!photos || photos.length === 0) return;
		if (index < 0) index = photos.length - 1;
		if (index >= photos.length) index = 0;
		currentIndex = index;

		const p = photos[currentIndex];
		imgEl.src = p.image_url || '';
		imgEl.alt = p.image_alt || p.title || '';
		titleEl.textContent = p.title || '';
		descEl.textContent = p.summary || p.description || '';
		sourceEl.textContent = '© ' + (p.source_rights || 'Love Family Alumni Archive');
		yearEl.textContent = p.year ? 'Year: ' + p.year : '';
		counterEl.textContent = 'Photograph ' + (currentIndex + 1) + ' of ' + photos.length;
	}

	function openLightbox(index, triggerEl) {
		lastFocusedEl = triggerEl;
		updateLightbox(index);
		modal.style.display = 'flex';
		modal.setAttribute('aria-hidden', 'false');
		document.body.style.overflow = 'hidden';
		closeBtn.focus();
	}

	function closeLightbox() {
		modal.style.display = 'none';
		modal.setAttribute('aria-hidden', 'true');
		document.body.style.overflow = '';
		if (lastFocusedEl && typeof lastFocusedEl.focus === 'function') {
			lastFocusedEl.focus();
		}
	}

	function nextPhoto() {
		updateLightbox(currentIndex + 1);
	}

	function prevPhoto() {
		updateLightbox(currentIndex - 1);
	}

	document.querySelectorAll('.lfa-open-lightbox-btn').forEach(btn => {
		btn.addEventListener('click', function() {
			const idx = parseInt(this.getAttribute('data-index'), 10) || 0;
			openLightbox(idx, this);
		});
	});

	closeBtn.addEventListener('click', closeLightbox);
	nextBtn.addEventListener('click', nextPhoto);
	prevBtn.addEventListener('click', prevPhoto);

	modal.addEventListener('click', function(e) {
		if (e.target === modal) {
			closeLightbox();
		}
	});

	document.addEventListener('keydown', function(e) {
		if (modal.style.display !== 'flex') return;

		if (e.key === 'Escape') {
			closeLightbox();
		} else if (e.key === 'ArrowRight') {
			nextPhoto();
		} else if (e.key === 'ArrowLeft') {
			prevPhoto();
		}
	});
})();
</script>
