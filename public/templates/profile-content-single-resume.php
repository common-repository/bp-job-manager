<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Display single resume.
 *
 * @param  int $post_id Post ID.
 * @return void
 */
function bpjm_show_resume_at_profile( $post_id)
{
	global $post;
	$fields_display = get_user_meta( bp_loggedin_user_id(), 'bpjm_display_fields', true );
	$display_resume = ( isset( $fields_display['display_resume'] ) ) ? $fields_display['display_resume'] : 'no';

if ( 'yes' !== $display_resume ) {
	return;
}
	$post = get_post( $post_id, OBJECT );
	setup_postdata( $post );
if ( isset( $fields_display['email'] ) || isset( $fields_display['prof_title'] ) || isset( $fields_display['location'] ) || isset( $fields_display['video'] ) || isset( $fields_display['description'] ) ) {
	?>
		<div class="bp-widget">
		<?php if ( ! empty( $fields_display['email'] ) || ! empty( $fields_display['prof_title'] ) || ! empty( $fields_display['location'] ) || ! empty( $fields_display['video'] ) || ! empty( $fields_display['description'] ) ) { ?>
			<h2><?php echo esc_html( apply_filters( 'bpjm_profile_peronal_inf_txt', 'Personal Information' ) ); ?></h2>
			<?php } ?>
			<table class="profile-fields">
				<?php
				if ( ! empty( $fields_display['email'] ) ) {
					$email = get_post_meta( $post_id, '_candidate_email', true );
					echo "<tr>
								<td class='label'>" . esc_html__( 'E-mail', 'bp-job-manager' ) . "</td>
								<td class='data'>" . esc_html( sanitize_email( $email ) ) . '</td>
							  </tr>';
				}
				if ( ! empty( $fields_display['prof_title'] ) ) {
					?>
					<tr>
						<td class="label"><?php esc_html_e( 'Professional Title', 'bp-job-manager' ); ?></td>
						<td class="data"><?php the_candidate_title(); ?></td>
					</tr>
					<?php
				}
				if ( ! empty( $fields_display['location'] ) ) {
					?>
					<tr>
						<td class="label"><?php esc_html_e( 'Location', 'bp-job-manager' ); ?></td>
						<td class="data"><?php the_candidate_location(); ?></td>
					</tr>
					<?php
				}
				if ( ! empty( $fields_display['video'] ) ) {
					?>
					<tr>
						<td class="label"><?php esc_html_e( 'Video', 'bp-job-manager' ); ?></td>
						<td class="data"><?php the_candidate_video(); ?></td>
					</tr>
					<?php
				}
				if ( ! empty( $fields_display['description'] ) ) {
					?>
					<tr>
						<td class="label"><?php esc_html_e( 'Description', 'bp-job-manager' ); ?></td>
						<td class="data"><?php echo wp_kses_post( apply_filters( 'the_resume_description', get_the_content() ) ); ?></td>
					</tr>
					<?php
				}
				?>
			</table>
		</div>
			<?php
		}
		if ( ! empty( $fields_display['url'] ) ) {
			?>
		<div class="bp-widget">
			<h2><?php echo esc_html( apply_filters( 'bpjm_profile_urls_txt', 'URL(s)' ) ); ?></h2>
			<table class="profile-fields">
				<tr>
					<td class="label"><?php esc_html_e( 'URL(s)', 'bp-job-manager' ); ?></td>
					<td class="data"><?php the_resume_links(); ?></td>
				</tr>
			</table>
		</div>
			<?php
		}
		if ( ! empty( $fields_display['education'] ) ) {
			if ( $items = get_post_meta( $post_id, '_candidate_education', true ) ) :
				?>
			<div class="bp-widget">
				<h2><?php echo esc_html( apply_filters( 'bpjm_profile_education_txt', 'Education' ) ); ?></h2>
				<table class="profile-fields">
					<?php
					$c = 0;
					foreach ( $items as $item ) :
						if ( $c % 2 == 0 ) {
							$setclass = 'bpjm-set-even';
						} else {
							$setclass = 'bpjm-set-odd';
						}
						echo '<tr class="' . esc_html( $setclass ) . '">
						<td class="label">' . esc_html__( 'School Name', 'bp-job-manager' ) . '</td>
						<td class="data">' . esc_html( $item['location'] ) . '</td>
					 </tr>';
						echo '<tr class="' . esc_html( $setclass ) . '">
						<td class="label">' . esc_html__( 'Qualification', 'bp-job-manager' ) . '</td>
						<td class="data">' . esc_html( $item['qualification'] ) . '</td>
					 </tr>';
						echo '<tr class="' . esc_html( $setclass ) . '">
						<td class="label">' . esc_html__( 'Date', 'bp-job-manager' ) . '</td>
						<td class="data">' . esc_html( $item['date'] ) . '</td>
					 </tr>';
						echo '<tr class="' . esc_html( $setclass ) . '">
						<td class="label">' . esc_html__( 'Notes', 'bp-job-manager' ) . '</td>
						<td class="data">' . esc_html( wpautop( wptexturize( $item['notes'] ) ) ) . '</td>
					 </tr>';
						$c++;
						endforeach;
					?>
				</table>
			</div>
				<?php
			endif;
		}
		if ( ! empty( $fields_display['experience'] ) ) {
			if ( $items = get_post_meta( $post_id, '_candidate_experience', true ) ) :
				?>
			<div class="bp-widget">
				<h2>
					<?php
					// Translate the string first
					$translated_experience_text = esc_html__( 'Experience', 'bp-job-manager' );

					// Apply the filter to the translated string
					$filtered_experience_text = apply_filters( 'bpjm_profile_experience_txt', $translated_experience_text );

					// Escape and echo the filtered text
					echo esc_html( $filtered_experience_text );
					?>
				</h2>
				<table class="profile-fields">
					<?php
					$c = 0;
					foreach ( $items as $item ) :
						if ( $c % 2 == 0 ) {
							$setclass = 'bpjm-set-even';
						} else {
							$setclass = 'bpjm-set-odd';
						}
						echo '<tr class="' . esc_html( $setclass ) . '">
						<td class="label">' . esc_html__( 'Employer', 'bp-job-manager' ) . '</td>
						<td class="data">' . esc_html( $item['employer'] ) . '</td>
					 </tr>';
						echo '<tr class="' . esc_html( $setclass ) . '">
						<td class="label">' . esc_html__( 'Job Title', 'bp-job-manager' ) . '</td>
						<td class="data">' . esc_html( $item['job_title'] ) . '</td>
					 </tr>';
						echo '<tr class="' . esc_html( $setclass ) . '">
						<td class="label">' . esc_html__( 'Date', 'bp-job-manager' ) . '</td>
						<td class="data">' . esc_html( $item['date'] ) . '</td>
					 </tr>';
						echo '<tr class="' . esc_html( $setclass ) . '">
						<td class="label">' . esc_html__( 'Notes', 'bp-job-manager' ) . '</td>
						<td class="data">' . esc_html( wpautop( wptexturize( $item['notes'] ) ) ) . '</td>
					 </tr>';
						$c++;
						endforeach;
					?>
				</table>
			</div>
				<?php
			endif;
		}
		?>
	<?php
	wp_reset_postdata();
}
