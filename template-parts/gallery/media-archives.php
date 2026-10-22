<?php
/**
 * Gallery & Archives — Media Archives Section (Videos, Documents & Publications)
 *
 * @package Love_Family_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$gallery_data = isset( $args['data'] ) && is_array( $args['data'] ) ? $args['data'] : [];
$videos       = [];
$documents    = [];
$publications = [];

if ( class_exists( 'LFA_Archives' ) ) {
	$db_items = LFA_Archives::get_items( [ 'per_page' => 100 ] );
	foreach ( $db_items['items'] as $it ) {
		if ( $it['kind'] === 'video' ) {
			$videos[] = [
				'id'        => $it['id'],
				'title'     => $it['title'],
				'duration'  => 'Excerpt',
				'speaker'   => 'Alumni Leadership',
				'date'      => $it['year'] ? 'Year ' . $it['year'] : 'Archival Recording',
				'desc'      => $it['summary'] ?: $it['description'],
				'video_url' => $it['video_url'],
				'is_real'   => true,
			];
		} elseif ( $it['kind'] === 'document' ) {
			$documents[] = [
				'id'           => $it['id'],
				'title'        => $it['title'],
				'pages'        => $it['file_size_human'] ?: 'PDF Document',
				'format'       => 'Official PDF',
				'date'         => $it['year'] ? 'Year ' . $it['year'] : 'Ratified Document',
				'desc'         => $it['summary'] ?: $it['description'],
				'access_level' => $it['access_level'],
				'can_access'   => $it['can_access'],
				'download_url' => $it['download_url'],
				'is_real'      => true,
			];
		} elseif ( $it['kind'] === 'publication' ) {
			$publications[] = [
				'id'           => $it['id'],
				'title'        => $it['title'],
				'issue'        => $it['year'] ? 'Edition ' . $it['year'] : 'Archival Bulletin',
				'format'       => 'Digital Publication',
				'desc'         => $it['summary'] ?: $it['description'],
				'access_level' => $it['access_level'],
				'download_url' => $it['download_url'],
				'is_real'      => true,
			];
		}
	}
}

// Fallback to demo items if database has none
if ( empty( $videos ) ) {
	$videos = $gallery_data['videos'] ?? [];
}
if ( empty( $documents ) ) {
	$documents = $gallery_data['documents'] ?? [];
}
if ( empty( $publications ) ) {
	$publications = $gallery_data['publications'] ?? [];
}
?>

<section id="gallery-media-archives" class="lfa-media-archives-section" aria-labelledby="archives-heading" style="padding: 80px 0; background: #F8FAFC; border-top: 1px solid #E2E8F0;">
	<div class="lfa-container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
		<div style="text-align: center; margin-bottom: 45px;">
			<span class="lfa-pill" style="display: inline-block; padding: 6px 14px; background: rgba(10,32,58,0.08); color: #0A203A; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; border-radius: 999px; margin-bottom: 12px;">
				Multimedia &amp; Document Repository
			</span>
			<h2 id="archives-heading" style="font-family: 'Playfair Display', serif; font-size: 2.5rem; font-weight: 800; color: #0A203A; margin: 0 0 14px;">
				Archived Recordings, Documents &amp; Publications
			</h2>
			<p style="color: #64748B; font-size: 1.05rem; max-width: 700px; margin: 0 auto;">
				Explore digitized assembly recordings, foundational constitutions, meeting minutes, and commemorative publications.
			</p>
		</div>

		<!-- 3-Column Grid of Document & Media Types -->
		<div class="lfa-archives-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 30px;">
			
			<!-- Column 1: Archived Videos & Recordings -->
			<div class="lfa-archive-column">
				<div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px; border-bottom: 1px solid #EDF2F7; padding-bottom: 14px;">
					<span style="display: inline-flex; align-items: center; justify-content: center; width: 38px; height: 38px; border-radius: 8px; background: rgba(171,22,64,0.1); color: #AB1640; font-weight: bold; font-size: 0.95rem;">
						&#9658;
					</span>
					<div>
						<h3 style="font-size: 1.2rem; font-weight: 800; color: #0A203A; margin: 0;">Archived Videos</h3>
						<span style="font-size: 0.75rem; color: #64748B; font-weight: 600;">Conference &amp; Fellowship Recordings</span>
					</div>
				</div>

				<div style="display: flex; flex-direction: column; gap: 18px;">
					<?php foreach ( $videos as $v ) : ?>
					<div class="lfa-archive-card">
						<div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
							<strong style="color: #0A203A; font-size: 0.95rem; line-height: 1.35;"><?php echo esc_html( $v['title'] ); ?></strong>
							<span style="font-size: 0.72rem; background: #0A203A; color: #FFFFFF; padding: 2px 7px; border-radius: 4px; font-weight: 600;"><?php echo esc_html( $v['duration'] ?? 'Video' ); ?></span>
						</div>
						<p style="font-size: 0.85rem; color: #475569; margin: 0 0 12px; line-height: 1.5;"><?php echo esc_html( $v['desc'] ); ?></p>
						<div style="display: flex; justify-content: space-between; align-items: center; margin-top: auto;">
							<span style="font-size: 0.75rem; color: #64748B;"><?php echo esc_html( $v['date'] ); ?></span>
							<button type="button" class="lfa-archive-btn lfa-archive-btn--crimson lfa-open-media-btn"
								data-media-type="video"
								data-media-title="<?php echo esc_attr( $v['title'] ); ?>"
								data-media-meta="<?php echo esc_attr( ($v['duration'] ?? 'HD') . ' • ' . $v['date'] . ' • ' . ($v['speaker'] ?? 'Council Recording') ); ?>"
								data-media-desc="<?php echo esc_attr( $v['desc'] ); ?>"
								aria-haspopup="dialog">
								Play Excerpt &rarr;
							</button>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>

			<!-- Column 2: Historical Documents & Minutes -->
			<div class="lfa-archive-column">
				<div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px; border-bottom: 1px solid #EDF2F7; padding-bottom: 14px;">
					<span style="display: inline-flex; align-items: center; justify-content: center; width: 38px; height: 38px; border-radius: 8px; background: rgba(198,147,61,0.15); color: #C6933D; font-weight: bold; font-size: 1.1rem;">
						&#128196;
					</span>
					<div>
						<h3 style="font-size: 1.2rem; font-weight: 800; color: #0A203A; margin: 0;">Constitutions &amp; Minutes</h3>
						<span style="font-size: 0.75rem; color: #64748B; font-weight: 600;">Governance Charters &amp; Records</span>
					</div>
				</div>

				<div style="display: flex; flex-direction: column; gap: 18px;">
					<?php foreach ( $documents as $doc ) : 
						$access = $doc['access_level'] ?? 'public';
					?>
					<div class="lfa-archive-card">
						<div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px; gap: 8px;">
							<strong style="color: #0A203A; font-size: 0.95rem; line-height: 1.35;"><?php echo esc_html( $doc['title'] ); ?></strong>
							<?php if ( $access === 'restricted_staff' ) : ?>
								<span style="font-size: 0.7rem; background: #FEE2E2; color: #991B1B; padding: 2px 7px; border-radius: 4px; font-weight: 700; white-space: nowrap;">Staff Only</span>
							<?php elseif ( $access === 'members_only' ) : ?>
								<span style="font-size: 0.7rem; background: #FEF3C7; color: #92400E; padding: 2px 7px; border-radius: 4px; font-weight: 700; white-space: nowrap;">Members Only</span>
							<?php else : ?>
								<span style="font-size: 0.7rem; background: #DCFCE7; color: #166534; padding: 2px 7px; border-radius: 4px; font-weight: 700; white-space: nowrap;">Public</span>
							<?php endif; ?>
						</div>
						<p style="font-size: 0.85rem; color: #475569; margin: 0 0 12px; line-height: 1.5;"><?php echo esc_html( $doc['desc'] ); ?></p>
						<div style="display: flex; justify-content: space-between; align-items: center; margin-top: auto; flex-wrap: wrap; gap: 8px;">
							<span style="font-size: 0.75rem; color: #64748B;"><?php echo esc_html( $doc['pages'] ?? 'PDF' ); ?> &bull; <?php echo esc_html( $doc['date'] ); ?></span>
							<?php if ( ! empty( $doc['download_url'] ) ) : ?>
								<a href="<?php echo esc_url( $doc['download_url'] ); ?>" class="lfa-archive-btn lfa-archive-btn--navy" style="text-decoration:none; display:inline-block;" target="_blank">
									Download PDF &rarr;
								</a>
							<?php else : ?>
								<button type="button" class="lfa-archive-btn lfa-archive-btn--navy lfa-open-media-btn"
									data-media-type="document"
									data-media-title="<?php echo esc_attr( $doc['title'] ); ?>"
									data-media-meta="<?php echo esc_attr( ($doc['format'] ?? 'PDF') . ' • ' . ($doc['pages'] ?? '') . ' • ' . $doc['date'] ); ?>"
									data-media-desc="<?php echo esc_attr( $doc['desc'] ); ?>"
									aria-haspopup="dialog">
									Open PDF &rarr;
								</button>
							<?php endif; ?>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>

			<!-- Column 3: Publications & Newsletters -->
			<div class="lfa-archive-column">
				<div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px; border-bottom: 1px solid #EDF2F7; padding-bottom: 14px;">
					<span style="display: inline-flex; align-items: center; justify-content: center; width: 38px; height: 38px; border-radius: 8px; background: rgba(30,64,175,0.1); color: #1E40AF; font-weight: bold; font-size: 1.1rem;">
						&#128214;
					</span>
					<div>
						<h3 style="font-size: 1.2rem; font-weight: 800; color: #0A203A; margin: 0;">Publications &amp; Bulletins</h3>
						<span style="font-size: 0.75rem; color: #64748B; font-weight: 600;">Annual Newsletters &amp; Commemoratives</span>
					</div>
				</div>

				<div style="display: flex; flex-direction: column; gap: 18px;">
					<?php foreach ( $publications as $pub ) : ?>
					<div class="lfa-archive-card">
						<div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
							<strong style="color: #0A203A; font-size: 0.95rem; line-height: 1.35;"><?php echo esc_html( $pub['title'] ); ?></strong>
							<span style="font-size: 0.72rem; background: #DBEAFE; color: #1E40AF; padding: 2px 7px; border-radius: 4px; font-weight: 600;">Issue</span>
						</div>
						<p style="font-size: 0.85rem; color: #475569; margin: 0 0 12px; line-height: 1.5;"><?php echo esc_html( $pub['desc'] ); ?></p>
						<div style="display: flex; justify-content: space-between; align-items: center; margin-top: auto;">
							<span style="font-size: 0.75rem; color: #64748B;"><?php echo esc_html( $pub['issue'] ); ?></span>
							<button type="button" class="lfa-archive-btn lfa-archive-btn--blue lfa-open-media-btn"
								data-media-type="publication"
								data-media-title="<?php echo esc_attr( $pub['title'] ); ?>"
								data-media-meta="<?php echo esc_attr( $pub['issue'] . ' • ' . ($pub['format'] ?? 'Digital') ); ?>"
								data-media-desc="<?php echo esc_attr( $pub['desc'] ); ?>"
								aria-haspopup="dialog">
								Read Issue &rarr;
							</button>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>

		</div>
	</div>

	<!-- Custom Accessible Media Preview Modal Dialog -->
	<div id="lfa-archive-media-modal" class="lfa-media-modal-backdrop" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="lfa-modal-title">
		<div class="lfa-media-modal">
			<div class="lfa-media-modal-header">
				<div>
					<span id="lfa-modal-category" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.1em; color: #C6933D; font-weight: 700; display: block; margin-bottom: 4px;">Media Archive</span>
					<h3 id="lfa-modal-title" style="font-size: 1.25rem; font-weight: 800; color: #FFFFFF; margin: 0; line-height: 1.3;">Item Preview</h3>
				</div>
				<button type="button" class="lfa-media-close-btn" id="lfa-modal-close" aria-label="Close modal preview">&times;</button>
			</div>
			<div class="lfa-media-modal-body">
				<div id="lfa-modal-preview-container">
					<!-- Dynamically injected player or document simulator -->
				</div>
				<div style="margin-top: 16px;">
					<div id="lfa-modal-meta" style="font-size: 0.82rem; font-weight: 600; color: #64748B; margin-bottom: 8px;">Metadata</div>
					<p id="lfa-modal-desc" style="font-size: 0.92rem; color: #334155; line-height: 1.6; margin: 0;">Description text goes here.</p>
				</div>
			</div>
			<div class="lfa-media-modal-footer">
				<button type="button" class="btn" id="lfa-modal-secondary-btn" style="padding: 8px 18px; font-size: 0.85rem; border-radius: 6px; background: #E2E8F0; color: #0A203A; border: none; cursor: pointer; font-weight: 600;">Close</button>
				<button type="button" class="btn btn-crimson" id="lfa-modal-action-btn" style="padding: 8px 18px; font-size: 0.85rem; border-radius: 6px; font-weight: 600; cursor: pointer;">Download Copy (Demo)</button>
			</div>
		</div>
	</div>

	<!-- Modal Controller Script -->
	<script>
	(function() {
		const modal = document.getElementById('lfa-archive-media-modal');
		if (!modal) return;
		const closeBtn = document.getElementById('lfa-modal-close');
		const secBtn = document.getElementById('lfa-modal-secondary-btn');
		const actBtn = document.getElementById('lfa-modal-action-btn');
		const titleEl = document.getElementById('lfa-modal-title');
		const catEl = document.getElementById('lfa-modal-category');
		const metaEl = document.getElementById('lfa-modal-meta');
		const descEl = document.getElementById('lfa-modal-desc');
		const previewContainer = document.getElementById('lfa-modal-preview-container');

		function closeModal() {
			modal.classList.remove('is-open');
			modal.setAttribute('aria-hidden', 'true');
			document.body.style.overflow = '';
		}

		function openModal(btn) {
			const type = btn.getAttribute('data-media-type') || 'document';
			const title = btn.getAttribute('data-media-title') || 'Archive Record';
			const meta = btn.getAttribute('data-media-meta') || '';
			const desc = btn.getAttribute('data-media-desc') || '';

			titleEl.textContent = title;
			metaEl.textContent = meta;
			descEl.textContent = desc;

			if (type === 'video') {
				catEl.textContent = 'Conference & Assembly Video Archive';
				actBtn.textContent = 'Save Video Note';
				previewContainer.innerHTML = `
					<div class="lfa-sim-player">
						<div style="width: 64px; height: 64px; border-radius: 50%; background: rgba(171,22,64,0.9); display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 8px 24px rgba(0,0,0,0.4); margin-bottom: 12px; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
							<span style="font-size: 1.5rem; margin-left: 4px; color: #FFF;">&#9658;</span>
						</div>
						<div style="font-size: 0.85rem; color: #CBD5E1; font-weight: 600;">Playback Excerpt Preview &bull; HD 1080p</div>
						<div style="position: absolute; bottom: 0; left: 0; right: 0; height: 40px; background: rgba(6,22,48,0.9); display: flex; align-items: center; justify-content: space-between; padding: 0 16px; font-size: 0.75rem; color: #94A3B8;">
							<span>00:00 / ${meta.split('•')[0] || '15:00'}</span>
							<div style="flex: 1; height: 4px; background: rgba(255,255,255,0.2); border-radius: 2px; margin: 0 16px; position: relative;">
								<div style="width: 25%; height: 100%; background: #AB1640; border-radius: 2px;"></div>
							</div>
							<span>1080p HD</span>
						</div>
					</div>
				`;
			} else if (type === 'document') {
				catEl.textContent = 'Governance & Charter Records';
				actBtn.textContent = 'Download Official PDF (Demo)';
				previewContainer.innerHTML = `
					<div class="lfa-sim-doc">
						<div style="border-bottom: 1px solid #CBD5E1; padding-bottom: 12px; margin-bottom: 16px; display: flex; justify-content: space-between; align-items: center;">
							<div>
								<span style="font-size: 0.75rem; font-weight: 700; color: #0A203A; text-transform: uppercase; letter-spacing: 0.05em;">The Love Family Alumni &mdash; NA Zone</span>
								<div style="font-size: 0.8rem; color: #64748B;">Archival Reference Document</div>
							</div>
							<span style="font-size: 0.7rem; background: #FEF3C7; color: #92400E; padding: 3px 8px; border-radius: 4px; font-weight: 700; border: 1px solid #FDE68A;">OFFICIAL SEAL</span>
						</div>
						<div style="flex: 1; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; padding: 20px 0;">
							<span style="font-size: 2.5rem; margin-bottom: 8px;">&#128196;</span>
							<strong style="color: #0A203A; font-size: 1.05rem; max-width: 450px;">${title}</strong>
							<p style="font-size: 0.82rem; color: #64748B; margin: 6px 0 0;">Authorized Member Document Preview &bull; Complete PDF Ready</p>
						</div>
						<div style="border-top: 1px solid #CBD5E1; padding-top: 10px; display: flex; justify-content: space-between; font-size: 0.75rem; color: #64748B;">
							<span>Page 1 of Document</span>
							<span>Integrity Hash: Verified</span>
						</div>
					</div>
				`;
			} else {
				catEl.textContent = 'Alumni Publication & Newsletter';
				actBtn.textContent = 'Read Full Edition (Demo)';
				previewContainer.innerHTML = `
					<div class="lfa-sim-doc" style="background: linear-gradient(135deg, #EFF6FF 0%, #FFFFFF 100%);">
						<div style="border-bottom: 1px solid #DBEAFE; padding-bottom: 12px; margin-bottom: 16px; display: flex; justify-content: space-between; align-items: center;">
							<div>
								<span style="font-size: 0.75rem; font-weight: 700; color: #1E40AF; text-transform: uppercase; letter-spacing: 0.05em;">Commemorative Issue</span>
								<div style="font-size: 0.8rem; color: #64748B;">North America Zonal Digest</div>
							</div>
							<span style="font-size: 0.7rem; background: #DBEAFE; color: #1E40AF; padding: 3px 8px; border-radius: 4px; font-weight: 700;">DIGITAL EDITION</span>
						</div>
						<div style="flex: 1; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; padding: 20px 0;">
							<span style="font-size: 2.5rem; margin-bottom: 8px;">&#128214;</span>
							<strong style="color: #0A203A; font-size: 1.05rem; max-width: 450px;">${title}</strong>
							<p style="font-size: 0.82rem; color: #64748B; margin: 6px 0 0;">Interactive digital reader &bull; High resolution editorial spread</p>
						</div>
						<div style="border-top: 1px solid #DBEAFE; padding-top: 10px; display: flex; justify-content: space-between; font-size: 0.75rem; color: #64748B;">
							<span>Editorial Feature</span>
							<span>Full Color Spread</span>
						</div>
					</div>
				`;
			}

			modal.classList.add('is-open');
			modal.setAttribute('aria-hidden', 'false');
			document.body.style.overflow = 'hidden';
			closeBtn.focus();
		}

		document.querySelectorAll('.lfa-open-media-btn').forEach(btn => {
			btn.addEventListener('click', () => openModal(btn));
		});

		closeBtn.addEventListener('click', closeModal);
		secBtn.addEventListener('click', closeModal);
		actBtn.addEventListener('click', () => {
			actBtn.textContent = 'Preparing Download...';
			setTimeout(() => {
				actBtn.textContent = 'Downloaded (Demo)';
				setTimeout(closeModal, 1200);
			}, 700);
		});

		modal.addEventListener('click', (e) => {
			if (e.target === modal) closeModal();
		});

		document.addEventListener('keydown', (e) => {
			if (e.key === 'Escape' && modal.classList.contains('is-open')) {
				closeModal();
			}
		});
	})();
	</script>
</section>

