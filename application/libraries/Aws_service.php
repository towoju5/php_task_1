<?php
use Aws\S3\S3Client;
class Aws_service
{
  public $_image_model;
  public $_s3;
  public $_bucket;

  public function set_s3 ($version, $region, $key, $secret)
  {
    $this->_s3 = new S3Client([
      'version' => $version,
      'region'  => $region,
      'credentials' => [
          'key'    => $key,
          'secret' => $secret
      ]
    ]);
  }

  public function set_image_model ($image_model)
  {
    $this->_image_model = $image_model;
  }

  public function set_bucket ($bucket)
  {
    $this->_bucket = $bucket;
  }

  public function delete_image ($image_id)
  {
    try
    {
      $model = $this->_image_model->get($image_id);
      $url = $model->url;

      $this->delete_image_url($url);
      $this->_image_model->real_delete($image_id);
      return TRUE;
     }
     catch (AwsExceptionInterface $e)
     {
      // throw Exception\StorageException::deleteError($path, $e);
      return FALSE;
     }
  }

  public function delete_image_url ($url)
  {
    try
    {
      $matches = [];
      $re = '/\/com.nds.*\//m';
      preg_match_all($re, $url, $matches, PREG_SET_ORDER, 0);
      if(count($matches) == 1 && count($matches[0]) == 1)
      {
        $bucket = str_replace('/','', $matches[0][0]);
        $parts = explode('/', $url);
        $key = $parts[count($parts) - 1];

        $this->_s3->deleteObject(['Bucket' => $bucket, 'Key' => $key]);
      }
      return TRUE;
     }
     catch (AwsExceptionInterface $e)
     {
      // throw Exception\StorageException::deleteError($path, $e);
      return FALSE;
     }
  }
}