<?php

namespace Elao\Bundle\MceMediaBundle\Validator\Constraints;

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;

use Symfony\Component\Validator\Exception\ConstraintDefinitionException;

/**
 * Validate image selected from media manager
 */
class ImageValidator extends ConstraintValidator
{
    /**
     * Validate image selected from media manager
     *
     * @param string     $value      value
     * @param Constraint $constraint constraint
     *
     * @return boolean
     */
    public function isValid($value, Constraint $constraint)
    {
        if ('' === $value) {
            return true;
        }

        $path = $constraint->path;
        if (is_array($constraint->path) && is_callable($constraint->path)) {
            $path = call_user_func($constraint->path);
        }

        $filename = $path . $value;

        $size = @getimagesize($filename);

        if (empty($size) || ($size[0] === 0) || ($size[1] === 0)) {
            $this->setMessage($constraint->sizeNotDetectedMessage);

            return false;
        }

        $width  = $size[0];
        $height = $size[1];

        if ($constraint->minWidth) {
            if (!ctype_digit((string) $constraint->minWidth)) {
                throw new ConstraintDefinitionException(sprintf('"%s" is not a valid minimum width', $constraint->minWidth));
            }

            if ($width < $constraint->minWidth) {
                $this->setMessage($constraint->minWidthMessage, array(
                    '{{ width }}'    => $width,
                    '{{ min_width }}' => $constraint->minWidth
                ));

                return false;
            }
        }

        if ($constraint->maxWidth) {
            if (!ctype_digit((string) $constraint->maxWidth)) {
                throw new ConstraintDefinitionException(sprintf('"%s" is not a valid maximum width', $constraint->maxWidth));
            }

            if ($width > $constraint->maxWidth) {
                $this->setMessage($constraint->maxWidthMessage, array(
                    '{{ width }}'    => $width,
                    '{{ max_width }}' => $constraint->maxWidth
                ));

                return false;
            }
        }

        if ($constraint->minHeight) {
            if (!ctype_digit((string) $constraint->minHeight)) {
                throw new ConstraintDefinitionException(sprintf('"%s" is not a valid minimum height', $constraint->minHeight));
            }

            if ($height < $constraint->minHeight) {
                $this->setMessage($constraint->minHeightMessage, array(
                    '{{ height }}'    => $height,
                    '{{ min_height }}' => $constraint->minHeight
                ));

                return false;
            }
        }

        if ($constraint->maxHeight) {
            if (!ctype_digit((string) $constraint->maxHeight)) {
                throw new ConstraintDefinitionException(sprintf('"%s" is not a valid maximum height', $constraint->maxHeight));
            }

            if ($height > $constraint->maxHeight) {
                $this->setMessage($constraint->maxHeightMessage, array(
                    '{{ height }}'    => $height,
                    '{{ max_height }}' => $constraint->maxHeight
                ));

                return false;
            }
        }

        return true;
    }
}