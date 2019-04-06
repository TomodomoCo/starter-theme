install:
	npm ci
	composer install --no-dev --optimize-autoloader

build: install
	npm run build

archive:
	zip -r theme.zip . \
		-x "*.git*" \
		-x "*.DS_Store*" \
		-x "src/assets/*" \
		-x "node_modules/*" \
		-x "gulpfile.js" \
		-x "package*.json" \
		-x "composer*" \
		-x "*.md" \
		-x "webpack*" \
		-x "*.editorconfig" \
		-x "Makefile" \
		-x "*.xml" \
		-x ".eyeglass*" \
		-x "*.zip" \
		-x ".nvm*"

bundle: build archive
