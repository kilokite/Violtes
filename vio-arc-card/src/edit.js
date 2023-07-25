/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import {
	useBlockProps,
	RichText,
	InspectorControls,
	PanelColorSettings,
} from '@wordpress/block-editor';
import {
	PanelBody, Button
} from '@wordpress/components'


import { MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';;
/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {
	let mediaId
	function onChangeName(content) {
		setAttributes({ name: content })
	}
	function onChangeContent(content) {
		setAttributes({ content });
	}
	return (
		<>
			<InspectorControls>
				<PanelColorSettings
					title='Color'
					initialOpen={true}
					colorSettings={[
						{
							value: attributes.textColor,
							onChange: (color) => {
								setAttributes({ textColor: color })
							},
							label: 'Text Color'
						},
						{
							value: attributes.backgroundColor,
							onChange: (color) => {
								setAttributes({ backgroundColor: color })
							},
							label: 'Background Color'
						}
					]}
				/>
				<PanelBody
					title='Image'
					initialOpen={true}
				>
					<MediaUploadCheck fallback={
						<p>no promession</p>
					}>
						<MediaUpload
							title='backgorund'
							allowedTypes={['image']}
							onSelect={(media) => {
								setAttributes({ backgroundImage: media.url })
							}}
							value={attributes.backgroundImage}
							render={({ open }) => (
								<Button
									onClick={open}
								>
									select backgroundImage
								</Button>
							)}
						/>
					</MediaUploadCheck>
				</PanelBody>
			</InspectorControls>
			<div
				{...useBlockProps()}
				style={{
					backgroundColor: attributes.backgroundColor,
					backgroundImage: `url(${attributes.backgroundImage})`,
					backgroundPosition: 'center',
				}}
			>
				<div class="info">
					<div class="avatar">
						<MediaUpload
							onSelect={(media) =>
								setAttributes({ avatar: media.url })
							}
							allowedTypes={['image']}
							value={mediaId}
							render={({ open }) => (
								<img
									src={attributes.avatar}
									onClick={open}
								/>
							)} />
					</div>
					<div
						class="text"
						style={{
							color: attributes.textColor,
						}}
					>
						<RichText
							tagName="p"
							value={attributes.name}
							onChange={onChangeName}
							placeholder={__('Your name', 'vio-arc-card')}
							className="name"
						/>
						<RichText
							tagName='p'
							value={attributes.content}
							onChange={onChangeContent}
							placeholder='Your content'
							className='content'
						/>
					</div>
				</div>
				<div class="url">
					<RichText
						tagName='a'
						value={attributes.url}
						onChange={(content) => {
							setAttributes({ url: content })
						}}
						placeholder='Your url'
					/>
				</div>
			</div>
		</>
	);
}