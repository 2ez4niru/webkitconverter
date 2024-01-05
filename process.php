<?php 
error_reporting(0);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['webkitData'])):
?>
    <?php
        $webkitData = $_POST['webkitData'];
        $formData = [];

        $boundary = substr($webkitData, 0, strpos($webkitData, "\r\n"));
        $parts = array_slice(explode($boundary, $webkitData), 1);

        foreach ($parts as $part) {
            if ($part == "--\r\n") break;

            list($rawHeaders, $content) = explode("\r\n\r\n", trim($part), 2);
            $content = trim($content);

            $rawHeaders = explode("\r\n", $rawHeaders);
            foreach ($rawHeaders as $header) {
                if (strpos($header, 'Content-Disposition:') !== false && strpos($header, 'name=') !== false) {
                    preg_match('/name="([^"]+)"/', $header, $matches);
                    $fieldName = $matches[1];
                    $formData[$fieldName] = $content;
                }
            }
        }

        $queryString = http_build_query($formData);
    ?>
    <div><?php echo htmlspecialchars($queryString); ?></div>
<?php endif; ?>