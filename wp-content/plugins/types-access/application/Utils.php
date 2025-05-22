<?php

namespace OTGS\Toolset\Access;

class Utils {

	/**
	 * @param array $args
	 *   0   string Requested capability.
	 *   1   int    Concerned user ID.
	 *   ..2 mixed Optional second and further parameters, typically object ID.
	 *
	 * @return int|null
	 */
	static function getObjectIdFromCapabilitiesArguments( $args ) {
		if ( ! isset( $args[2] ) ) {
			return null;
		}

		$candidate = $args[2];

		if ( is_int( $candidate ) ) {
			return (int) $candidate;
		}
		if ( is_string( $candidate ) && ctype_digit( $candidate ) ) {
			return (int) $candidate;
		}
		if ( is_a( $candidate, 'WP_Block_Editor_Context' ) && is_a( $candidate->post, 'WP_Post' ) ) {
			return (int) $candidate->post->ID;
		}

		return null;
	}

}
