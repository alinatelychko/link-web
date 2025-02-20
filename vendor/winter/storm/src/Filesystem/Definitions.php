<?php namespace Winter\Storm\Filesystem;

use Winter\Storm\Support\Facades\Config;
use Exception;

/**
 * File definitions helper.
 * Contains file extensions for common use cases.
 *
 * @author Alexey Bobkov, Samuel Georges
 */
class Definitions
{

    /**
     * Lock down the constructor for this class.
     */
    final public function __construct()
    {
    }

    /**
     * Entry point to request a definition set.
     */
    public static function get(string $type): array
    {
        return (new static)->getDefinitions($type);
    }

    /**
     * Returns a definition set from config or from the default sets.
     *
     * @throws Exception If the provided definition type does not exist.
     */
    public function getDefinitions(string $type): array
    {
        if (!method_exists($this, $type)) {
            throw new Exception(sprintf('No such definition set exists for "%s"', $type));
        }

        return (array) Config::get('cms.fileDefinitions.'.$type, $this->$type());
    }

    /**
     * Determines if a path should be ignored based on the ignoreFiles and ignorePatterns definitions.
     *
     * Returns `true` if the path is ignored, `false` otherwise.
     *
     * @todo Efficiency of this method can be improved.
     */
    public static function isPathIgnored(string $path): bool
    {
        $ignoreNames = self::get('ignoreFiles');
        $ignorePatterns = self::get('ignorePatterns');

        if (in_array($path, $ignoreNames)) {
            return true;
        }

        foreach ($ignorePatterns as $pattern) {
            if (preg_match('/'.$pattern.'/', $path)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Files that can be safely ignored.
     *
     * This list can be customized with the config:
     *
     * `cms.fileDefinitions.ignoreFiles`
     */
    protected function ignoreFiles(): array
    {
        return [
            '.svn',
            '.git',
            '.DS_Store',
            '.AppleDouble'
        ];
    }

    /**
     * File patterns that can be safely ignored.
     *
     * This list can be customized with the config:
     *
     * `cms.fileDefinitions.ignorePatterns`
     */
    protected function ignorePatterns(): array
    {
        return [
            '^\..*'
        ];
    }

    /**
     * Extensions that are particularly benign.
     *
     * This list can be customized with config:
     *
     * `cms.fileDefinitions.defaultExtensions`
     */
    protected function defaultExtensions(): array
    {
        return [
            'avi',
            'avif',
            'bmp',
            'css',
            'doc',
            'docx',
            'eot',
            'flv',
            'gif',
            'ico',
            'ics',
            'jpeg',
            'jpg',
            'js',
            'less',
            'map',
            'mkv',
            'mov',
            'mp3',
            'mp4',
            'mpeg',
            'ods',
            'odt',
            'ogg',
            'pdf',
            'png',
            'ppt',
            'pptx',
            'rar',
            'scss',
            'svg',
            'swf',
            'ttf',
            'txt',
            'wav',
            'webm',
            'webp',
            'wmv',
            'woff',
            'woff2',
            'xls',
            'xlsx',
            'zip',
        ];
    }

    /**
     * Extensions seen as public assets.
     *
     * This list can be customized with config:
     *
     * `cms.fileDefinitions.assetExtensions`
     */
    protected function assetExtensions(): array
    {
        return [
            'avif',
            'bmp',
            'css',
            'eot',
            'gif',
            'ico',
            'jpeg',
            'jpg',
            'js',
            'json',
            'less',
            'md',
            'png',
            'sass',
            'scss',
            'svg',
            'ttf',
            'webp',
            'woff',
            'woff2',
        ];
    }

    /**
     * Extensions typically used as images.
     *
     * This list can be customized with config:
     *
     * `cms.fileDefinitions.imageExtensions`
     */
    protected function imageExtensions(): array
    {
        return [
            'avif',
            'bmp',
            'gif',
            'jpeg',
            'jpg',
            'png',
            'svg',
            'webp',
        ];
    }

    /**
     * Extensions typically used as video files.
     *
     * This list can be customized with config:
     *
     * `cms.fileDefinitions.videoExtensions`
     */
    protected function videoExtensions(): array
    {
        return [
            'avi',
            'mkv',
            'mov',
            'mp4',
            'mpeg',
            'mpg',
            'webm',
        ];
    }

    /**
     * Extensions typically used as audio files.
     *
     * This list can be customized with config:
     *
     * `cms.fileDefinitions.audioExtensions`
     */
    protected function audioExtensions(): array
    {
        return [
            'm4a',
            'mp3',
            'ogg',
            'wav',
            'wma',
        ];
    }
}
