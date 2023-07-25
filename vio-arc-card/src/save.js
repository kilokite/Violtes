/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, RichText } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
 *
 * @return {WPElement} Element to render.
 */
export default function save({ attributes }) {
	console.log(attributes.backgroundImage)
	return (
		<div
			{...useBlockProps.save()}
			style={{
				backgroundColor: attributes.backgroundColor,
				backgroundImage: `url(${attributes.backgroundImage})`,
			}}
		>
			<div class="info">
				<div class="avatar">
					<img
						src={attributes.avatar}
					/>
				</div>
				<div
					class="text"
					style={{
						color: attributes.textColor,
					}}
				>
					<RichText.Content
						tagName="p"
						value={attributes.name}
						className="name"
					/>
					<RichText.Content
						tagName='p'
						value={attributes.content}
						className='content'
					/>
				</div>
			</div>
			<div class="url">
				<a href={attributes.url}>{attributes.url}</a>
			</div>
		</div>
	);
}
