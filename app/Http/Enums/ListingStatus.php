<?php

namespace App\Http\Enums;

enum ListingStatus: string
{
    case DRAFT = "DRAFT";
    case PENDING_APPROVAL = "PENDING_APPROVAL";
    case PUBLISHED = "PUBLISHED";
    case REJECTED = "REJECTED";
    case EXPIRED = "EXPIRED";
    case DELETED = "DELETED";
}
